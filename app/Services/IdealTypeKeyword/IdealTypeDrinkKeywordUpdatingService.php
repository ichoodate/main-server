<?php

namespace App\Services\IdealTypeKeyword;

use App\Models\IdealTypeKeyword;
use App\Models\Keyword\Drink;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Keyword\Drink\DrinkFindingService;
use FunctionalCoding\Service;

class IdealTypeDrinkKeywordUpdatingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'auth_user.keywords' => function ($authUser) {
                $keywordIds = (new Drink())->query()
                    ->select(Drink::ID)
                    ->getQuery()
                ;

                (new IdealTypeKeyword())->query()
                    ->where(IdealTypeKeyword::USER_ID, $authUser->getKey())
                    ->whereIn(IdealTypeKeyword::KEYWORD_ID, $keywordIds)
                    ->delete()
                ;
            },
        ];
    }

    public static function getLoaders()
    {
        return [
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'auth_token' => $authToken,
                ], [
                    'auth_token' => '{{auth_token}}',
                ]];
            },

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

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'keyword_id' => ['required'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
