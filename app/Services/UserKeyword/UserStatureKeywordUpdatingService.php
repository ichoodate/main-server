<?php

namespace App\Services\UserKeyword;

use App\Models\Keyword\Stature;
use App\Models\UserKeyword;
use App\Services\Keyword\Stature\StatureFindingService;
use FunctionalCoding\Service;

class UserStatureKeywordUpdatingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'auth_user.keywords' => function ($authUser) {
                $keywordIds = (new Stature())->query()
                    ->select(Stature::ID)
                    ->getQuery()
                ;

                (new UserKeyword())->query()
                    ->where(UserKeyword::USER_ID, $authUser->getKey())
                    ->whereIn(UserKeyword::KEYWORD_ID, $keywordIds)
                    ->delete()
                ;
            },
        ];
    }

    public static function getLoaders()
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
                return (new UserKeyword())->create([
                    UserKeyword::USER_ID => $authUser->getKey(),
                    UserKeyword::KEYWORD_ID => $keyword->getKey(),
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
            'auth_user' => ['required'],

            'keyword_id' => ['required'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
