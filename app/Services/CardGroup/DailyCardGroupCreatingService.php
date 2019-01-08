<?php

namespace App\Services\CardGroup;

use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Database\Models\IdealTypable;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Service;
use App\Services\User\MatchingUserRandommingService;

class DailyCardGroupCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'card_group'
                => 'card group created within {{local_date}} date',

            'ideal_typables'
                => 'ideal typables for {{local_date}} and {{timezone}}',

            'ideal_typable_keyword_ids'
                => 'keyword ids of {{ideal_typables}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'card_group' => ['auth_user', 'now_timezone_date_to_utc', function ($authUser, $nowTimezoneDateToUtc) {

                $query = inst(CardGroup::class)->aliasQuery()
                    ->qSelect(CardGroup::ID)
                    ->qWhere(CardGroup::USER_ID, $authUser->getKey())
                    ->getQuery();

                return inst(CardGroup::class)->aliasQuery()
                    ->qWhereIn(CardGroup::ID, $query)
                    ->qWhere(CardGroup::TYPE, CardGroup::TYPE_DAILY)
                    ->qWhere(CardGroup::CREATED_AT, '>=', $nowTimezoneDateToUtc->format('Y-m-d H:i:s'))
                    ->first();
            }],

            'created' => ['auth_user', function ($authUser) {

                return inst(CardGroup::class)->create([
                    CardGroup::USER_ID => $authUser->getKey(),
                    CardGroup::TYPE    => CardGroup::TYPE_DAILY
                ]);
            }],

            'ideal_typables' => ['auth_user', function ($authUser) {

                return inst(IdealTypable::class)->aliasQuery()
                    ->qWhere(IdealTypable::USER_ID, $authUser->getKey())
                    ->get();
            }],

            'ideal_typable_keyword_ids' => ['ideal_typables', function ($idealTypables) {

                return $idealTypables->pluck(IdealTypable::KEYWORD_ID)->all();
            }],

            'users' => ['ideal_typable_keyword_ids', function ($idealTypableKeywordIds) {

                return [MatchingUserRandommingService::class, [
                    'keyword_ids'
                        => implode(',', $idealTypableKeywordIds),
                    'limit'
                        => 4
                ], [
                    'keyword_ids'
                        => '{{ideal_typable_keyword_ids}}'
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
            'card_group'
                => ['null']
        ];
    }

    public static function getArrTraitClasses()
    {
        return [
            AuthUserRequiringService::class,
            NowTimezoneService::class
        ];
    }

}
