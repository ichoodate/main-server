<?php

namespace App\Services\Card;

use App\Models\Card;
use App\Models\CardFlip;
use App\Models\Friend;
use App\Models\Matching;
use App\Models\User;
use FunctionalCoding\ORM\Eloquent\Service\PaginationListService;
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

    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'query.after' => function ($after, $query, $timezone) {
                $time = new \DateTime($after, new \DateTimeZone($timezone));
                $time->setTimezone(new \DateTimeZone('UTC'));

                $query->where(Card::UPDATED_AT, '>=', $time->format('Y-m-d H:i:s'));
            },

            'query.auth_user' => function ($authUserQuery, $matchingUserQuery, $query, $queryMainBuilder, $authUserStatus = '', $matchStatus = '', $matchingUserStatus = '') {
                if ('' != $matchStatus) {
                    $userQuery = (new User())->query()
                        ->select(User::ID)
                        ->whereIn(User::ID, $matchingUserQuery)
                        ->orWhereIn(User::ID, $authUserQuery)
                        ->getQuery()
                    ;

                    $queryMainBuilder($query, $userQuery, $matchStatus);
                } elseif ($authUserStatus && !$matchingUserStatus) {
                    $queryMainBuilder($query, $authUserQuery, $authUserStatus);
                } elseif (!$authUserStatus && $matchingUserStatus) {
                    $queryMainBuilder($query, $matchingUserQuery, $matchingUserStatus);
                } else { // if ( $authUserStatus && $matchingUserStatus )
                    $queryMainBuilder($query, $authUserQuery, $authUserStatus);
                    $queryMainBuilder($query, $matchingUserQuery, $matchingUserStatus);
                }
            },

            'query.before' => function ($before, $query, $timezone) {
                $time = new \DateTime($before, new \DateTimeZone($timezone));
                $time->setTimezone(new \DateTimeZone('UTC'));

                $query->where(Card::UPDATED_AT, '<=', $time->format('Y-m-d H:i:s'));
            },
        ];
    }

    public static function getLoaders()
    {
        return [
            'auth_user_id_field' => function ($authUser) {
                if (User::GENDER_MAN == $authUser->{User::GENDER}) {
                    return Matching::MAN_ID;
                }

                return Matching::WOMAN_ID;
            },

            'auth_user_query' => function ($authUser) {
                return (new User())->query()
                    ->select(User::ID)
                    ->where(User::ID, $authUser->getKey())
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
                        ->select(Card::SHOWNER_ID)
                        ->where(Card::CHOOSER_ID, $authUser->getKey())
                        ->getQuery()
                    ;
                } elseif (self::CARD_TYPE_SHOWNER == $cardType) {
                    $userQuery = (new Card())->query()
                        ->select(Card::CHOOSER_ID)
                        ->where(Card::SHOWNER_ID, $authUser->getKey())
                        ->getQuery()
                    ;
                } elseif (self::CARD_TYPE_BOTH == $cardType) {
                    $subQuery1 = (new Card())->query()
                        ->select(Card::SHOWNER_ID)
                        ->where(Card::CHOOSER_ID, $authUser->getKey())
                        ->getQuery()
                    ;
                    $subQuery2 = (new Card())->query()
                        ->select(Card::CHOOSER_ID)
                        ->where(Card::SHOWNER_ID, $authUser->getKey())
                        ->getQuery()
                    ;

                    $userQuery = (new User())->query()
                        ->select(User::ID)
                        ->whereIn(User::ID, $subQuery1)
                        ->orWhereIn(User::ID, $subQuery2)
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
                    $return->where(Card::CHOOSER_ID, $authUser->getKey());
                } elseif (self::CARD_TYPE_SHOWNER == $cardType) {
                    $return->where(Card::SHOWNER_ID, $authUser->getKey());
                } elseif (self::CARD_TYPE_BOTH == $cardType) {
                    $subQuery = Matching::query()
                        ->where($authUserIdField, $authUser->getKey())
                        ->selectIdQuery()
                    ;

                    $return->whereIn(Card::MATCH_ID, $subQuery);
                }

                return $return;
            },

            'query_main_builder' => function ($querySubBuilder) {
                return function ($cardQuery, $userQuery, $userStatus) use ($querySubBuilder) {
                    if (in_array($userStatus, [self::USER_STATUS_CARD_FLIP, self::USER_STATUS_FRIEND])) {
                        $subQuery = $querySubBuilder($userQuery, $userStatus);

                        $cardQuery->whereIn(Card::ID, $subQuery);
                    } elseif (self::USER_STATUS_CARD_FLIP_STEP == $userStatus) {
                        $subQuery = $querySubBuilder($userQuery, self::USER_STATUS_CARD_FLIP);

                        $cardQuery->whereNotIn(Card::ID, $subQuery);
                    } elseif (self::USER_STATUS_FRIEND_STEP == $userStatus) {
                        $inSubQuery = $querySubBuilder($userQuery, self::USER_STATUS_CARD_FLIP);
                        $notInSubQuery = $querySubBuilder($userQuery, self::USER_STATUS_FRIEND);

                        $cardQuery->whereIn(Card::ID, $inSubQuery);
                        $cardQuery->whereNotIn(Card::ID, $notInSubQuery);
                    }
                    // else if ( $userStatus == self::USER_STATUS_ALL )
                    // {
                    // }

                    return $cardQuery->getQuery();
                };
            },

            'query_sub_builder' => function () {
                return function ($userQuery, $userStatus) {
                    $flipQuery = (new CardFlip())->query()
                        ->whereIn(CardFlip::USER_ID, $userQuery)
                        ->select(CardFlip::CARD_ID)
                        ->getQuery()
                    ;

                    if (self::USER_STATUS_CARD_FLIP == $userStatus) {
                        return $flipQuery;
                    }
                    if (self::USER_STATUS_FRIEND == $userStatus) {
                        $friendQuery = (new Friend())->query()
                            ->whereIn(Friend::SENDER_ID, $userQuery)
                            ->select(Friend::MATCH_ID)
                            ->getQuery()
                        ;

                        return (new Card())->query()
                            ->whereIn(Card::MATCH_ID, $friendQuery)
                            ->whereIn(Card::ID, $flipQuery)
                            ->select(Card::ID)
                            ->getQuery()
                        ;
                    }
                };
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'after' => ['date_format:Y-m-d H:i:s'],

            'auth_user' => ['required'],

            'auth_user_status' => ['in:'.implode(',', static::USER_STATUS_VALUES)],

            'before' => ['date_format:Y-m-d H:i:s'],

            'card_type' => ['in:'.implode(',', static::CARD_TYPE_VALUES)],

            'match_status' => ['in:'.implode(',', static::USER_STATUS_VALUES)],

            'matching_user_status' => ['in:'.implode(',', static::USER_STATUS_VALUES)],

            'timezone' => ['required_with:after', 'required_with:before', 'timezone'],
        ];
    }

    public static function getTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
