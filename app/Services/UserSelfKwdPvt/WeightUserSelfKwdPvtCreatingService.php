<?php

namespace App\Services\UserSelfKwdPvt;

use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\Keyword\Weight;
use App\Service;
use App\Services\ListingService;
use App\Services\Keyword\Weight\WeightFindingService;

class WeightUserSelfKwdPvtCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'auth_user' => ['auth_user', function ($authUser) {

                $keywordIds = inst(Weight::class)->query()
                    ->qSelect(Weight::ID)
                    ->getQuery();

                inst(UserSelfKwdPvt::class)->query()
                    ->qWhere(UserSelfKwdPvt::USER_ID, $authUser->getKey())
                    ->qWhereIn(UserSelfKwdPvt::KEYWORD_ID, $keywordIds)
                    ->delete();
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'keyword' => ['keyword_id', function ($keywordId) {

                return [WeightFindingService::class, [
                    'id'
                        => $keywordId
                ], [
                    'id'
                        => '{{keyword_id}}'
                ]];
            }],

            'result' => ['auth_user', 'keyword', function ($authUser, $keyword) {

                return inst(UserSelfKwdPvt::class)->create([
                    UserSelfKwdPvt::USER_ID => $authUser->getKey(),
                    UserSelfKwdPvt::KEYWORD_ID => $keyword->getKey()
                ]);
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

            'keyword_id'
                => ['required']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}