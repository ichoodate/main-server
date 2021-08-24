<?php

namespace App\Services\UserKeyword;

use App\Models\Keyword\Residence;
use App\Models\UserKeyword;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Keyword\Residence\ResidenceFindingService;
use FunctionalCoding\Service;

class UserResidenceKeywordUpdatingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbacks()
    {
        return [
            'auth_user' => function ($authUser) {
                $keywordIds = (new Residence())->query()
                    ->select(Residence::ID)
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

    public static function getArrLoaders()
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
                return [ResidenceFindingService::class, [
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
            'keyword_id' => ['required'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
