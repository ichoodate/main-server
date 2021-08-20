<?php

namespace App\Services\UserKeyword;

use App\Models\Keyword\Drink;
use App\Models\UserKeyword;
use App\Services\Keyword\Drink\DrinkFindingService;
use FunctionalCoding\Service;

class UserDrinkKeywordCreatingService extends Service
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

                (new UserKeyword())->query()
                    ->qWhere(UserKeyword::USER_ID, $authUser->getKey())
                    ->qWhereIn(UserKeyword::KEYWORD_ID, $keywordIds)
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
                return (new UserKeyword())->create([
                    UserKeyword::USER_ID => $authUser->getKey(),
                    UserKeyword::KEYWORD_ID => $keyword->getKey(),
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
