<?php

namespace App\Services\UserIdealTypeKwdPvt;

use App\Database\Models\UserIdealTypeKwdPvt;
use App\Database\Models\Keyword\Hobby;
use Illuminate\Extend\Service;
use App\Services\ListingService;
use App\Services\Keyword\Hobby\HobbyFindingService;

class HobbyUserIdealTypeKwdPvtCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'keywords.*'
                => 'keyword.* of {{keyword_ids}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'auth_user' => function ($authUser) {

                $keywordIds = (new Hobby)->query()
                    ->qSelect(Hobby::ID)
                    ->getQuery();

                (new UserIdealTypeKwdPvt)->query()
                    ->qWhere(UserIdealTypeKwdPvt::USER_ID, $authUser->getKey())
                    ->qWhereIn(UserIdealTypeKwdPvt::KEYWORD_ID, $keywordIds)
                    ->delete();
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'keywords' => function ($keywordIds) {

                $keywordIds = preg_split('/\s*,\s*/', $keywordIds);

                return Hobby::query()
                    ->findMany($keywordIds)
                    ->sortByIds($keywordIds);
            },

            'result' => function ($authUser, $keywords) {

                $result = (new UserIdealTypeKwdPvt)->newCollection();

                foreach ( $keywords as $keyword )
                {
                    $result->push((new UserIdealTypeKwdPvt)->create([
                        UserIdealTypeKwdPvt::USER_ID => $authUser->getKey(),
                        UserIdealTypeKwdPvt::KEYWORD_ID => $keyword->getKey()
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
            'auth_user'
                => ['required'],

            'keyword_ids'
                => ['required', 'integers'],

            'keywords.*'
                => ['required', 'not_null']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
