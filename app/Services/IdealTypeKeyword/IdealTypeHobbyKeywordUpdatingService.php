<?php

namespace App\Services\IdealTypeKeyword;

use App\Models\IdealTypeKeyword;
use App\Models\Keyword\Hobby;
use FunctionalCoding\Service;

class IdealTypeHobbyKeywordUpdatingService extends Service
{
    public static function getBindNames()
    {
        return [
            'keywords' => 'hobbies for {{keyword_ids}}',

            'keywords.*' => 'hobbies[*] for {{keyword_ids}}',
        ];
    }

    public static function getCallbacks()
    {
        return [
            'auth_user.keywords' => function ($authUser) {
                $keywordIds = (new Hobby())->query()
                    ->select(Hobby::ID)
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

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'auth_user' => ['required'],

            'keyword_ids' => ['required', 'integers'],

            'keywords' => ['array'],

            'keywords.*' => ['not_null'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
