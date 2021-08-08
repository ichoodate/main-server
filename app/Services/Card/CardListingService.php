<?php

namespace App\Services\Card;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use App\Database\Models\Friend;
use App\Database\Models\Match;
use App\Database\Models\User;
use Illuminate\Extend\Service;
use App\Services\LimitedListingService;

class CardListingService extends Service {

    const CARD_TYPE_BOTH    = 'both';
    const CARD_TYPE_CHOOSER = 'chooser';
    const CARD_TYPE_SHOWNER = 'showner';

    const CARD_TYPE_VALUES = [
        self::CARD_TYPE_BOTH,
        self::CARD_TYPE_CHOOSER,
        self::CARD_TYPE_SHOWNER
    ];

    const USER_STATUS_ALL            = 'all';
    const USER_STATUS_CARD_FLIP      = 'card_flip';
    const USER_STATUS_CARD_FLIP_STEP = 'card_flip_step';
    const USER_STATUS_FRIEND         = 'friend';
    const USER_STATUS_FRIEND_STEP    = 'friend_step';

    const USER_STATUS_VALUES = [
        self::USER_STATUS_ALL,
        self::USER_STATUS_CARD_FLIP,
        self::USER_STATUS_CARD_FLIP_STEP,
        self::USER_STATUS_FRIEND,
        self::USER_STATUS_FRIEND_STEP,
    ];

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => ['query', 'query_builder_1', 'auth_user_query', 'matching_user_query', 'match_status', 'auth_user_status', 'matching_user_status', function ($query, $queryBuilder1, $authUserQuery, $matchingUserQuery, $matchStatus = null, $authUserStatus = null, $matchingUserStatus = null) {

                if ( $matchStatus != null )
                {
                    $userQuery = (new User)->query()
                        ->qSelect(User::ID)
                        ->qWhereIn(User::ID, $matchingUserQuery)
                        ->qOrWhereIn(User::ID, $authUserQuery)
                        ->getQuery();

                    $queryBuilder1->call(null, $query, $userQuery, $matchStatus);
                }
                else if ( $authUserStatus != null && $matchingUserStatus == null )
                {
                    $queryBuilder1->call(null, $query, $authUserQuery, $authUserStatus);
                }
                else if ( $authUserStatus == null && $matchingUserStatus != null )
                {
                    $queryBuilder1->call(null, $query, $matchingUserQuery, $matchingUserStatus);
                }
                else // if ( $authUserStatus != null && $matchingUserStatus != null )
                {
                    $queryBuilder1->call(null, $query, $authUserQuery, $authUserStatus);
                    $queryBuilder1->call(null, $query, $matchingUserQuery, $matchingUserStatus);
                }
            }],

            'query.after' => ['query', 'after', 'timezone', function ($query, $after, $timezone) {

                $time = new \DateTime($after, new \DateTimeZone($timezone));
                $time->setTimezone(new \DateTimeZone('UTC'));

                $query->qWhere(Card::UPDATED_AT, '>=', $time->format('Y-m-d H:i:s'));
            }],

            'query.before' => ['query', 'before', 'timezone', function ($query, $before, $timezone) {

                $time = new \DateTime($before, new \DateTimeZone($timezone));
                $time->setTimezone(new \DateTimeZone('UTC'));

                $query->qWhere(Card::UPDATED_AT, '<=', $time->format('Y-m-d H:i:s'));
            }],
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'auth_user_id_field' => ['auth_user', function ($authUser) {

                if ( $authUser->{User::GENDER} == User::GENDER_MAN )
                {
                    return Match::MAN_ID;
                }
                else
                {
                    return Match::WOMAN_ID;
                }
            }],

            'auth_user_query' => ['auth_user', function ($authUser) {

                return (new User)->query()
                    ->qSelect(User::ID)
                    ->qWhere(User::ID, $authUser->getKey())
                    ->getQuery();
            }],

            'available_expands' => [function () {

                return ['flips', 'chooser', 'chooser.facePhoto', 'chooser.popularity', 'group', 'match', 'match.following', 'showner', 'showner.facePhoto', 'showner.popularity'];
            }],

            'card_type' => [function () {

                return self::CARD_TYPE_BOTH;
            }],

            'cursor' => ['auth_user', 'cursor_id', function ($authUser, $cursorId) {

                return [CardFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $cursorId
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => '{{cursor_id}}'
                ]];
            }],

            'matching_user_query' => ['auth_user', 'card_type', function ($authUser, $cardType) {

                if ( $cardType == self::CARD_TYPE_CHOOSER )
                {
                    $userQuery = (new Card)->query()
                        ->qSelect(Card::SHOWNER_ID)
                        ->qWhere(Card::CHOOSER_ID, $authUser->getKey())
                        ->getQuery();
                }
                else if ( $cardType == self::CARD_TYPE_SHOWNER )
                {
                    $userQuery = (new Card)->query()
                        ->qSelect(Card::CHOOSER_ID)
                        ->qWhere(Card::SHOWNER_ID, $authUser->getKey())
                        ->getQuery();
                }
                else if ( $cardType == self::CARD_TYPE_BOTH )
                {
                    $subQuery1 = (new Card)->query()
                        ->qSelect(Card::SHOWNER_ID)
                        ->qWhere(Card::CHOOSER_ID, $authUser->getKey())
                        ->getQuery();
                    $subQuery2 = (new Card)->query()
                        ->qSelect(Card::CHOOSER_ID)
                        ->qWhere(Card::SHOWNER_ID, $authUser->getKey())
                        ->getQuery();

                    $userQuery = (new User)->query()
                        ->qSelect(User::ID)
                        ->qWhereIn(User::ID, $subQuery1)
                        ->qOrWhereIn(User::ID, $subQuery2)
                        ->getQuery();
                }

                return $userQuery;
            }],

            'model_class' => [function () {

                return Card::class;
            }],

            'query' => ['auth_user', 'card_type', 'auth_user_id_field', function ($authUser, $cardType, $authUserIdField) {

                $return = (new Card)->query();

                if ( $cardType == self::CARD_TYPE_CHOOSER )
                {
                    $return->qWhere(Card::CHOOSER_ID, $authUser->getKey());
                }
                else if ( $cardType == self::CARD_TYPE_SHOWNER )
                {
                    $return->qWhere(Card::SHOWNER_ID, $authUser->getKey());
                }
                else if ( $cardType == self::CARD_TYPE_BOTH )
                {
                    $subQuery = (new Match)->query()
                        ->qWhere($authUserIdField, $authUser->getKey())
                        ->selectIdQuery();

                    $return->qWhereIn(Card::MATCH_ID, $subQuery);
                }

                return $return;
            }],

            'query_builder_1' => ['query_builder_2', function ($queryBuilder2){

                return function ($cardQuery, $userQuery, $userStatus) use ($queryBuilder2) {

                    if ( in_array($userStatus, [self::USER_STATUS_CARD_FLIP, self::USER_STATUS_FRIEND]) )
                    {
                        $subQuery = $queryBuilder2->call(null, $userQuery, $userStatus);

                        $cardQuery->qWhereIn(Card::ID, $subQuery);
                    }
                    else if ( $userStatus == self::USER_STATUS_CARD_FLIP_STEP )
                    {
                        $subQuery = $queryBuilder2->call(null, $userQuery, self::USER_STATUS_CARD_FLIP);

                        $cardQuery->qWhereNotIn(Card::ID, $subQuery);
                    }
                    else if ( $userStatus == self::USER_STATUS_FRIEND_STEP )
                    {
                        $inSubQuery    = $queryBuilder2->call(null, $userQuery, self::USER_STATUS_CARD_FLIP);
                        $notInSubQuery = $queryBuilder2->call(null, $userQuery, self::USER_STATUS_FRIEND);

                        $cardQuery->qWhereIn(Card::ID, $inSubQuery);
                        $cardQuery->qWhereNotIn(Card::ID, $notInSubQuery);
                    }
                    // else if ( $userStatus == self::USER_STATUS_ALL )
                    // {
                    // }

                    return $cardQuery->getQuery();
                };
            }],

            'query_builder_2' => [function () {

                return function ($userQuery, $userStatus) {

                    $flipQuery = (new CardFlip)->query()
                        ->qWhereIn(CardFlip::USER_ID, $userQuery)
                        ->qSelect(CardFlip::CARD_ID)
                        ->getQuery();

                    if ( $userStatus == self::USER_STATUS_CARD_FLIP )
                    {
                        return $flipQuery;
                    }
                    else if ( $userStatus == self::USER_STATUS_FRIEND )
                    {
                        $friendQuery = (new Friend)->query()
                            ->qWhereIn(Friend::SENDER_ID, $userQuery)
                            ->qSelect(Friend::MATCH_ID)
                            ->getQuery();

                        return (new Card)->query()
                            ->qWhereIn(Card::MATCH_ID, $friendQuery)
                            ->qWhereIn(Card::ID, $flipQuery)
                            ->qSelect(Card::ID)
                            ->getQuery();
                    }
                };
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'after'
                => ['date_format:Y-m-d H:i:s'],

            'auth_user'
                => ['required'],

            'auth_user_status'
                => ['in:' . implode(',', static::USER_STATUS_VALUES)],

            'before'
                => ['date_format:Y-m-d H:i:s'],

            'card_type'
                => ['in:' . implode(',', static::CARD_TYPE_VALUES)],

            'match_status'
                => ['in:' . implode(',', static::USER_STATUS_VALUES)],

            'matching_user_status'
                => ['in:' . implode(',', static::USER_STATUS_VALUES)],

            'timezone'
                => ['required', 'timezone'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            LimitedListingService::class
        ];
    }

}
