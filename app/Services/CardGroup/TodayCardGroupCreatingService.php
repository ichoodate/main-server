<?php

namespace App\Services\CardGroup;

use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Database\Models\UserIdealTypeKwdPvt;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Service;
use App\Services\CardGroup\CardGroupCreatingService;
use App\Services\User\MatchingUserListingService;

class TodayCardGroupCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'today_card_group'
                => 'card group created within date',

            'user_ideal_type_kwd_pvt_keyword_ids'
                => 'ideal type keyword ids of {{auth_user}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'created' => ['auth_user', function ($authUser) {

                return (new CardGroup)->create([
                    CardGroup::USER_ID => $authUser->getKey(),
                    CardGroup::TYPE    => CardGroup::TYPE_DAILY
                ]);
            }],

            'today_card_group' => ['auth_user', function ($authUser) {

                $time = new \DateTime('now', new \DateTimeZone('UTC'));

                $query = (new CardGroup)->query()
                    ->qSelect(CardGroup::ID)
                    ->qWhere(CardGroup::USER_ID, $authUser->getKey())
                    ->getQuery();

                return (new CardGroup)->query()
                    ->qWhereIn(CardGroup::ID, $query)
                    ->qWhere(CardGroup::TYPE, CardGroup::TYPE_DAILY)
                    ->qWhere(CardGroup::CREATED_AT, '>=', $time->format('Y-m-d H:i:s'))
                    ->first();
            }],

            'user_ideal_type_kwd_pvts' => ['auth_user', function ($authUser) {

                return (new UserIdealTypeKwdPvt)->query()
                    ->qWhere(UserIdealTypeKwdPvt::USER_ID, $authUser->getKey())
                    ->get();
            }],

            'user_ideal_type_kwd_pvt_keyword_ids' => ['user_ideal_type_kwd_pvts', function ($userIdealTypeKwdPvts) {

                return $userIdealTypeKwdPvts->pluck(UserIdealTypeKwdPvt::KEYWORD_ID)->all();
            }],

            'users' => ['auth_user', 'user_ideal_type_kwd_pvt_keyword_ids', function ($authUser, $userIdealTypeKwdPvtKeywordIds) {

                return [MatchingUserListingService::class, [
                    'auth_user'
                        => $authUser,
                    'keyword_ids'
                        => implode(',', $userIdealTypeKwdPvtKeywordIds),
                    'limit'
                        => 4,
                    'strict'
                        => false
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'keyword_ids'
                        => '{{user_ideal_type_kwd_pvt_keyword_ids}}',
                ], [
                    'limit',
                    'strict'
                ]];
            }],

            'users_count' => ['users', function ($users) {

                $count = $users->count();

                if ( $count < 4 )
                {
                    throw new \Exception;
                }

                return $count;
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

            'today_card_group'
                => ['null']
        ];
    }

    public static function getArrTraits()
    {
        return [
            CardGroupCreatingService::class,
        ];
    }

}

