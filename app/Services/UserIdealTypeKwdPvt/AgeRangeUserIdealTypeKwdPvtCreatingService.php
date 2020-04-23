<?php

namespace App\Services\UserIdealTypeKwdPvt;

use App\Database\Models\UserIdealTypeKwdPvt;
use App\Database\Models\Keyword\AgeRange;
use App\Service;
use App\Services\ListingService;
use App\Services\Keyword\AgeRange\AgeRangeFindingService;

class AgeRangeUserIdealTypeKwdPvtCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'auth_user' => ['auth_user', function ($authUser) {

                $keywordIds = inst(AgeRange::class)->query()
                    ->qSelect(AgeRange::ID)
                    ->getQuery();

                inst(UserIdealTypeKwdPvt::class)->query()
                    ->qWhere(UserIdealTypeKwdPvt::USER_ID, $authUser->getKey())
                    ->qWhereIn(UserIdealTypeKwdPvt::KEYWORD_ID, $keywordIds)
                    ->delete();
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'keyword' => ['keyword_id', function ($keywordId) {

                return [AgeRangeFindingService::class, [
                    'id'
                        => $keywordId
                ], [
                    'id'
                        => '{{keyword_id}}'
                ]];
            }],

            'result' => ['auth_user', 'keyword', function ($authUser, $keyword) {

                return inst(UserIdealTypeKwdPvt::class)->create([
                    UserIdealTypeKwdPvt::USER_ID => $authUser->getKey(),
                    UserIdealTypeKwdPvt::KEYWORD_ID => $keyword->getKey(),
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