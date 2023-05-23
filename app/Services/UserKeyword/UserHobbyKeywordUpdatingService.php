<?php

namespace App\Services\UserKeyword;

use App\Models\Keyword\Hobby;
use App\Models\UserKeyword;
use FunctionalCoding\Service;

class UserHobbyKeywordUpdatingService extends Service
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
            'keywords' => function ($keywordIds) {
                $keywordIds = preg_split('/\s*,\s*/', $keywordIds);

                return Hobby::query()
                    ->findMany($keywordIds)
                    ->sortByIds($keywordIds)
                ;
            },

            'result' => function ($authUser, $keywords) {
                $result = (new UserKeyword())->newCollection();

                foreach ($keywords as $keyword) {
                    $result->push((new UserKeyword())->create([
                        UserKeyword::USER_ID => $authUser->getKey(),
                        UserKeyword::KEYWORD_ID => $keyword->getKey(),
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
