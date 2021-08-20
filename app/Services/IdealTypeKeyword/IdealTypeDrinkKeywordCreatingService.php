<?php

namespace App\Services\IdealTypeKeyword;

use App\Models\Keyword\Drink;
use App\Models\IdealTypeKeyword;
use App\Services\Keyword\Drink\DrinkFindingService;
use FunctionalCoding\Service;

class IdealTypeDrinkKeywordCreatingService extends Service
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

                (new IdealTypeKeyword())->query()
                    ->qWhere(IdealTypeKeyword::USER_ID, $authUser->getKey())
                    ->qWhereIn(IdealTypeKeyword::KEYWORD_ID, $keywordIds)
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
                return (new IdealTypeKeyword())->create([
                    IdealTypeKeyword::USER_ID => $authUser->getKey(),
                    IdealTypeKeyword::KEYWORD_ID => $keyword->getKey(),
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
