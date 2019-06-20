<?php

namespace App\Services\UserIdealTypeKwdPvt;

use App\Database\Models\UserIdealTypeKwdPvt;
use App\Database\Models\Keyword\Career;
use App\Service;
use App\Services\ListingService;
use App\Services\Keyword\Career\CareerFindingService;

class CareerUserIdealTypeKwdPvtUpdatingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'auth_user' => ['auth_user', function ($authUser) {

                $keywordIds = inst(Career::class)->query()
                    ->qSelect(Career::ID)
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

                return [CareerFindingService::class, [
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
                    UserIdealTypeKwdPvt::KEYWORD_ID => $keyword->getKey()
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
