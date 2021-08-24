<?php

namespace App\Services\IdealTypeKeyword;

use App\Models\IdealTypeKeyword;
use App\Models\Keyword\Residence;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Keyword\Residence\ResidenceFindingService;
use FunctionalCoding\Service;

class IdealTypeResidenceKeywordUpdatingService extends Service
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

                (new IdealTypeKeyword())->query()
                    ->where(IdealTypeKeyword::USER_ID, $authUser->getKey())
                    ->whereIn(IdealTypeKeyword::KEYWORD_ID, $keywordIds)
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
            'keyword_id' => ['required'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
