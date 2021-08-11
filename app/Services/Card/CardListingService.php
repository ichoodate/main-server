<?php

namespace App\Services\Card;

use App\Models\Card;
use App\Models\CardFlip;
use App\Models\Friend;
use App\Models\Match;
use App\Models\User;
use App\Services\LimitedListingService;
use FunctionalCoding\Service;

class CardListingService extends Service
{
    public const CARD_TYPE_BOTH = 'both';
    public const CARD_TYPE_CHOOSER = 'chooser';
    public const CARD_TYPE_SHOWNER = 'showner';

    public const CARD_TYPE_VALUES = [
        self::CARD_TYPE_BOTH,
        self::CARD_TYPE_CHOOSER,
        self::CARD_TYPE_SHOWNER,
    ];

    public const USER_STATUS_ALL = 'all';
    public const USER_STATUS_CARD_FLIP = 'card_flip';
    public const USER_STATUS_CARD_FLIP_STEP = 'card_flip_step';
    public const USER_STATUS_FRIEND = 'friend';
    public const USER_STATUS_FRIEND_STEP = 'friend_step';

    public const USER_STATUS_VALUES = [
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
            'query.after' => function ($after, $query, $timezone) {
                $time = new \DateTime($after, new \DateTimeZone($timezone));
                $time->setTimezone(new \DateTimeZone('UTC'));

                $query->qWhere(Card::UPDATED_AT, '>=', $time->format('Y-m-d H:i:s'));
            },

            'query.auth_user' => function ($authUserQuery, $authUserStatus = '', $matchStatus = '', $matchingUserQuery, $matchingUserStatus = '', $query, $queryBuilder1) {
                if ('' != $matchStatus) {
                    $userQuery = (new User())->query()
                        ->qSelect(User::ID)
                        ->qWhereIn(User::ID, $matchingUserQuery)
                        ->qOrWhereIn(User::ID, $authUserQuery)
                        ->getQuery()
                    ;

                    $queryBuilder1->call(null, $query, $userQuery, $matchStatus);
                } elseif ($authUserStatus && !$matchingUserStatus) {
                    $queryBuilder1->call(null, $query, $authUserQuery, $authUserStatus);
                } elseif (!$authUserStatus && $matchingUserStatus) {
                    $queryBuilder1->call(null, $query, $matchingUserQuery, $matchingUserStatus);
                } else { // if ( $authUserStatus && $matchingUserStatus )
                    $queryBuilder1->call(null, $query, $authUserQuery, $authUserStatus);
                    $queryBuilder1->call(null, $query, $matchingUserQuery, $matchingUserStatus);
                }
            },

            'query.before' => function ($before, $query, $timezone) {
                $time = new \DateTime($before, new \DateTimeZone($timezone));
                $time->setTimezone(new \DateTimeZone('UTC'));

                $query->qWhere(Card::UPDATED_AT, '<=', $time->format('Y-m-d H:i:s'));
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'auth_user_id_field' => function ($authUser) {
                if (User::GENDER_MAN == $authUser->{User::GENDER}) {
                    return Match::MAN_ID;
                }

                return Match::WOMAN_ID;
            },

            'auth_user_query' => function ($authUser) {
                return (new User())->query()
                    ->qSelect(User::ID)
                    ->qWhere(User::ID, $authUser->getKey())
                    ->getQuery()
                ;
            },

            'available_expands' => function () {
                return ['flips', 'chooser', 'chooser.facePhoto', 'chooser.popularity', 'group', 'match', 'match.following', 'showner', 'showner.facePhoto', 'showner.popularity'];
            },

            'card_type' => function () {
                return self::CARD_TYPE_BOTH;
            },

            'cursor' => function ($authUser, $cursorId) {
                return [CardFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $cursorId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{cursor_id}}',
                ]];
            },

            'matching_user_query' => function ($authUser, $cardType) {
                if (self::CARD_TYPE_CHOOSER == $cardType) {
                    $userQuery = (new Card())->query()
                        ->qSelect(Card::SHOWNER_ID)
                        ->qWhere(Card::CHOOSER_ID, $authUser->getKey())
                        ->getQuery()
                    ;
                } elseif (self::CARD_TYPE_SHOWNER == $cardType) {
                    $userQuery = (new Card())->query()
                        ->qSelect(Card::CHOOSER_ID)
                        ->qWhere(Card::SHOWNER_ID, $authUser->getKey())
                        ->getQuery()
                    ;
                } elseif (self::CARD_TYPE_BOTH == $cardType) {
                    $subQuery1 = (new Card())->query()
                        ->qSelect(Card::SHOWNER_ID)
                        ->qWhere(Card::CHOOSER_ID, $authUser->getKey())
                        ->getQuery()
                    ;
                    $subQuery2 = (new Card())->query()
                        ->qSelect(Card::CHOOSER_ID)
                        ->qWhere(Card::SHOWNER_ID, $authUser->getKey())
                        ->getQuery()
                    ;

                    $userQuery = (new User())->query()
                        ->qSelect(User::ID)
                        ->qWhereIn(User::ID, $subQuery1)
                        ->qOrWhereIn(User::ID, $subQuery2)
                        ->getQuery()
                    ;
                }

                return $userQuery;
            },

            'model_class' => function () {
                return Card::class;
            },

            'query' => function ($authUser, $authUserIdField, $cardType) {
                $return = (new Card())->query();

                if (self::CARD_TYPE_CHOOSER == $cardType) {
                    $return->qWhere(Card::CHOOSER_ID, $authUser->getKey());
                } elseif (self::CARD_TYPE_SHOWNER == $cardType) {
                    $return->qWhere(Card::SHOWNER_ID, $authUser->getKey());
                } elseif (self::CARD_TYPE_BOTH == $cardType) {
                    $subQuery = (new Match())->query()
                        ->qWhere($authUserIdField, $authUser->getKey())
                        ->selectIdQuery()
                    ;

                    $return->qWhereIn(Card::MATCH_ID, $subQuery);
                }

                return $return;
            },

            'query_builder_1' => function ($queryBuilder2) {
                return function ($cardQuery, $userQuery, $userStatus) use ($queryBuilder2) {
                    if (in_array($userStatus, [self::USER_STATUS_CARD_FLIP, self::USER_STATUS_FRIEND])) {
                        $subQuery = $queryBuilder2->call(null, $userQuery, $userStatus);

                        $cardQuery->qWhereIn(Card::ID, $subQuery);
                    } elseif (self::USER_STATUS_CARD_FLIP_STEP == $userStatus) {
                        $subQuery = $queryBuilder2->call(null, $userQuery, self::USER_STATUS_CARD_FLIP);

                        $cardQuery->qWhereNotIn(Card::ID, $subQuery);
                    } elseif (self::USER_STATUS_FRIEND_STEP == $userStatus) {
                        $inSubQuery = $queryBuilder2->call(null, $userQuery, self::USER_STATUS_CARD_FLIP);
                        $notInSubQuery = $queryBuilder2->call(null, $userQuery, self::USER_STATUS_FRIEND);

                        $cardQuery->qWhereIn(Card::ID, $inSubQuery);
                        $cardQuery->qWhereNotIn(Card::ID, $notInSubQuery);
                    }
                    // else if ( $userStatus == self::USER_STATUS_ALL )
                    // {
                    // }

                    return $cardQuery->getQuery();
                };
            },

            'query_builder_2' => function () {
                return function ($userQuery, $userStatus) {
                    $flipQuery = (new CardFlip())->query()
                        ->qWhereIn(CardFlip::USER_ID, $userQuery)
                        ->qSelect(CardFlip::CARD_ID)
                        ->getQuery()
                    ;

                    if (self::USER_STATUS_CARD_FLIP == $userStatus) {
                        return $flipQuery;
                    }
                    if (self::USER_STATUS_FRIEND == $userStatus) {
                        $friendQuery = (new Friend())->query()
                            ->qWhereIn(Friend::SENDER_ID, $userQuery)
                            ->qSelect(Friend::MATCH_ID)
                            ->getQuery()
                        ;

                        return (new Card())->query()
                            ->qWhereIn(Card::MATCH_ID, $friendQuery)
                            ->qWhereIn(Card::ID, $flipQuery)
                            ->qSelect(Card::ID)
                            ->getQuery()
                        ;
                    }
                };
            },
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'after' => ['date_format:Y-m-d H:i:s'],

            'auth_user' => ['required'],

            'auth_user_status' => ['in:'.implode(',', static::USER_STATUS_VALUES)],

            'before' => ['date_format:Y-m-d H:i:s'],

            'card_type' => ['in:'.implode(',', static::CARD_TYPE_VALUES)],

            'match_status' => ['in:'.implode(',', static::USER_STATUS_VALUES)],

            'matching_user_status' => ['in:'.implode(',', static::USER_STATUS_VALUES)],

            'timezone' => ['required', 'timezone'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            LimitedListingService::class,
        ];
    }
}
