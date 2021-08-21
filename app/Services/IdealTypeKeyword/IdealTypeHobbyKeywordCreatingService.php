<?php

namespace App\Services\IdealTypeKeyword;

use App\Models\IdealTypeKeyword;
use App\Models\Keyword\Hobby;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\Service;

class IdealTypeHobbyKeywordCreatingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'keywords.*' => 'keyword.* of {{keyword_ids}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'auth_user' => function ($authUser) {
                $keywordIds = (new Hobby())->query()
                    ->qSelect(Hobby::ID)
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

            'keywords' => function ($keywordIds) {
                $keywordIds = preg_split('/\s*,\s*/', $keywordIds);

                return Hobby::query()
                    ->findMany($keywordIds)
                    ->sortByIds($keywordIds)
                ;
            },

            'result' => function ($authUser, $keywords) {
                $result = (new IdealTypeKeyword())->newCollection();

                foreach ($keywords as $keyword) {
                    $result->push((new IdealTypeKeyword())->create([
                        IdealTypeKeyword::USER_ID => $authUser->getKey(),
                        IdealTypeKeyword::KEYWORD_ID => $keyword->getKey(),
                    ]));
                }

                return $result;
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
            'keyword_ids' => ['required', 'integers'],

            'keywords.*' => ['required', 'not_null'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
