<?php

namespace App\Services\IdealTypeKeyword;

use App\Models\IdealTypeKeyword;
use App\Models\Keyword\Religion;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Keyword\Religion\ReligionFindingService;
use FunctionalCoding\Service;

class IdealTypeReligionKeywordCreatingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'auth_user' => function ($authUser) {
                $keywordIds = (new Religion())->query()
                    ->qSelect(Religion::ID)
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
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'token' => $authToken,
                ], [
                    'token' => '{{auth_token}}',
                ]];
            },

            'keyword' => function ($keywordId) {
                return [ReligionFindingService::class, [
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
