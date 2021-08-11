<?php

namespace App\Services\UserSelfKwdPvt;

use App\Models\Keyword\Stature;
use App\Models\UserSelfKwdPvt;
use App\Services\Keyword\Stature\StatureFindingService;
use FunctionalCoding\Service;

class StatureUserSelfKwdPvtCreatingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'auth_user' => function ($authUser) {
                $keywordIds = (new Stature())->query()
                    ->qSelect(Stature::ID)
                    ->getQuery()
                ;

                (new UserSelfKwdPvt())->query()
                    ->qWhere(UserSelfKwdPvt::USER_ID, $authUser->getKey())
                    ->qWhereIn(UserSelfKwdPvt::KEYWORD_ID, $keywordIds)
                    ->delete()
                ;
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'keyword' => function ($keywordId) {
                return [StatureFindingService::class, [
                    'id' => $keywordId,
                ], [
                    'id' => '{{keyword_id}}',
                ]];
            },

            'result' => function ($authUser, $keyword) {
                return (new UserSelfKwdPvt())->create([
                    UserSelfKwdPvt::USER_ID => $authUser->getKey(),
                    UserSelfKwdPvt::KEYWORD_ID => $keyword->getKey(),
                ]);
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
            'auth_user' => ['required'],

            'keyword_id' => ['required'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
