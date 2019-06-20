<?php

namespace App\Services\Card;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Service;
use App\Services\PagingService;
use App\Services\CardActivity\CardActivityFindingService;
use App\Services\Match\MatchFindingService;

class CardPagingService extends Service {

    const CARD_TYPE_BOTH    = 'both';
    const CARD_TYPE_CHOOSER = 'chooser';
    const CARD_TYPE_SHOWNER = 'showner';

    const CARD_TYPE_VALUES = [
        self::CARD_TYPE_BOTH,
        self::CARD_TYPE_CHOOSER,
        self::CARD_TYPE_SHOWNER
    ];

    const USER_STATUS_ALL               = 'all';
    const USER_STATUS_CARD_FLIP         = 'card_flip';
    const USER_STATUS_CARD_FLIP_STEP    = 'card_flip_step';
    const USER_STATUS_CARD_OPEN         = 'card_open';
    const USER_STATUS_CARD_OPEN_STEP    = 'card_open_step';
    const USER_STATUS_CARD_PROPOSE      = 'card_propose';
    const USER_STATUS_CARD_PROPOSE_STEP = 'card_propose_step';

    const USER_STATUS_VALUES = [
        self::USER_STATUS_ALL,
        self::USER_STATUS_CARD_FLIP,
        self::USER_STATUS_CARD_FLIP_STEP,
        self::USER_STATUS_CARD_OPEN,
        self::USER_STATUS_CARD_OPEN_STEP,
        self::USER_STATUS_CARD_PROPOSE,
        self::USER_STATUS_CARD_PROPOSE_STEP
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
                    $userQuery = inst(User::class)->query()
                        ->qSelect(User::ID)
                        ->qWhereIn(User::ID, $matchingUserQuery)
                        ->qOrWhereIn(User::ID, $authUserQuery)
                        ->getQuery();

                    $queryBuilder1->call($this, $query, $userQuery, $matchStatus);
                }
                else if ( $authUserStatus != null && $matchingUserStatus == null )
                {
                    $queryBuilder1->call($this, $query, $authUserQuery, $authUserStatus);
                }
                else if ( $authUserStatus == null && $matchingUserStatus != null )
                {
                    $queryBuilder1->call($this, $query, $matchingUserQuery, $matchingUserStatus);
                }
                else // if ( $authUserStatus != null && $matchingUserStatus != null )
                {
                    $queryBuilder1->call($this, $query, $authUserQuery, $authUserStatus);
                    $queryBuilder1->call($this, $query, $matchingUserQuery, $matchingUserStatus);
                }
            }]
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

                return inst(User::class)->query()
                    ->qSelect(User::ID)
                    ->qWhere(User::ID, $authUser->getKey())
                    ->getQuery();
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
                    $userQuery = inst(Card::class)->query()
                        ->qSelect(Card::SHOWNER_ID)
                        ->qWhere(Card::CHOOSER_ID, $authUser->getKey())
                        ->getQuery();
                }
                else if ( $cardType == self::CARD_TYPE_SHOWNER )
                {
                    $userQuery = inst(Card::class)->query()
                        ->qSelect(Card::CHOOSER_ID)
                        ->qWhere(Card::SHOWNER_ID, $authUser->getKey())
                        ->getQuery();
                }
                else if ( $cardType == self::CARD_TYPE_BOTH )
                {
                    $subQuery1 = inst(Card::class)->query()
                        ->qSelect(Card::SHOWNER_ID)
                        ->qWhere(Card::CHOOSER_ID, $authUser->getKey())
                        ->getQuery();
                    $subQuery2 = inst(Card::class)->query()
                        ->qSelect(Card::CHOOSER_ID)
                        ->qWhere(Card::SHOWNER_ID, $authUser->getKey())
                        ->getQuery();

                    $userQuery = inst(User::class)->query()
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

                $return = inst(Card::class)->query();

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
                    $subQuery = inst(Match::class)->query()
                        ->qWhere($authUserIdField, $authUser->getKey())
                        ->selectIdQuery();

                    $return->qWhereIn(Card::MATCH_ID, $subQuery);
                }

                return $return;
            }],

            'query_builder_1' => ['query_builder_2', function ($queryBuilder2){

                return function ($cardQuery, $userQuery, $userStatus) use ($queryBuilder2) {

                    if ( $userStatus == self::USER_STATUS_ALL )
                    {

                    }
                    else if ( in_array($userStatus, [self::USER_STATUS_CARD_FLIP, self::USER_STATUS_CARD_OPEN, self::USER_STATUS_CARD_PROPOSE]) )
                    {
                        $subQuery = $queryBuilder2->call($this, $userQuery, $userStatus);

                        $cardQuery->qWhereIn(Card::ID, $subQuery);
                    }
                    else if ( $userStatus == self::USER_STATUS_CARD_FLIP_STEP )
                    {
                        $subQuery = $queryBuilder2->call($this, $userQuery, self::USER_STATUS_CARD_FLIP);

                        $cardQuery->qWhereNotIn(Card::ID, $subQuery);
                    }
                    else if ( in_array($userStatus, [self::USER_STATUS_CARD_OPEN_STEP, self::USER_STATUS_CARD_PROPOSE_STEP]) )
                    {
                        if ( $userStatus == self::USER_STATUS_CARD_OPEN_STEP )
                        {
                            $inStatus    = self::USER_STATUS_CARD_FLIP;
                            $notInStatus = self::USER_STATUS_CARD_OPEN;
                        }
                        else if ( $userStatus == self::USER_STATUS_CARD_PROPOSE_STEP )
                        {
                            $inStatus    = self::USER_STATUS_CARD_OPEN;
                            $notInStatus = self::USER_STATUS_CARD_PROPOSE;
                        }

                        $inSubQuery    = $queryBuilder2->call($this, $userQuery, $inStatus);
                        $notInSubQuery = $queryBuilder2->call($this, $userQuery, $notInStatus);

                        $cardQuery->qWhereIn(Card::ID, $inSubQuery);
                        $cardQuery->qWhereNotIn(Card::ID, $notInSubQuery);
                    }

                    return $cardQuery->getQuery();
                };
            }],

            'query_builder_2' => [function () {

                return function ($userQuery, $userStatus) {

                    $query = inst(Activity::class)->query()
                        ->qWhereIn(Activity::USER_ID, $userQuery)
                        ->qSelect(Activity::RELATED_ID);

                    if ( $userStatus == self::USER_STATUS_CARD_FLIP )
                    {
                        $query->qWhere(Activity::TYPE, Activity::TYPE_CARD_FLIP);
                    }
                    else if ( $userStatus == self::USER_STATUS_CARD_OPEN )
                    {
                        $query->qWhere(Activity::TYPE, Activity::TYPE_CARD_OPEN);
                    }
                    else if ( $userStatus == self::USER_STATUS_CARD_PROPOSE )
                    {
                        $query->qWhere(Activity::TYPE, Activity::TYPE_CARD_PROPOSE);
                    }

                    return $query->getQuery();
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
            'auth_user'
                => ['required'],

            'auth_user_status'
                => ['in:' . implode(',', static::USER_STATUS_VALUES)],

            'card_type'
                => ['in:' . implode(',', static::CARD_TYPE_VALUES)],

            'match_status'
                => ['in:' . implode(',', static::USER_STATUS_VALUES)],

            'matching_user_status'
                => ['in:' . implode(',', static::USER_STATUS_VALUES)],
        ];
    }

    public static function getArrTraits()
    {
        return [
            PagingService::class
        ];
    }

}
