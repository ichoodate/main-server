<?php

namespace App\Services\UserIdealTypeKwdPvt;

use App\Models\Keyword\Drink;
use App\Models\UserIdealTypeKwdPvt;
use App\Services\Keyword\Drink\DrinkFindingService;
use FunctionalCoding\Service;

class DrinkUserIdealTypeKwdPvtCreatingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'auth_user' => function ($authUser) {
                $keywordIds = (new Drink())->query()
                    ->qSelect(Drink::ID)
                    ->getQuery()
                ;

                (new UserIdealTypeKwdPvt())->query()
                    ->qWhere(UserIdealTypeKwdPvt::USER_ID, $authUser->getKey())
                    ->qWhereIn(UserIdealTypeKwdPvt::KEYWORD_ID, $keywordIds)
                    ->delete()
                ;
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'keyword' => function ($keywordId) {
                return [DrinkFindingService::class, [
                    'id' => $keywordId,
                ], [
                    'id' => '{{keyword_id}}',
                ]];
            },

            'result' => function ($authUser, $keyword) {
                return (new UserIdealTypeKwdPvt())->create([
                    UserIdealTypeKwdPvt::USER_ID => $authUser->getKey(),
                    UserIdealTypeKwdPvt::KEYWORD_ID => $keyword->getKey(),
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
