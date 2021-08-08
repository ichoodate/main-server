<?php

namespace App\Services\UserSelfKwdPvt;

use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\Keyword\Hobby;
use Illuminate\Extend\Service;
use App\Services\ListingService;
use App\Services\Keyword\Hobby\HobbyFindingService;

class HobbyUserSelfKwdPvtCreatingService extends Service {

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

                (new UserSelfKwdPvt)->query()
                    ->qWhere(UserSelfKwdPvt::USER_ID, $authUser->getKey())
                    ->qWhereIn(UserSelfKwdPvt::KEYWORD_ID, $keywordIds)
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

                $result = (new UserSelfKwdPvt)->newCollection();

                foreach ( $keywords as $keyword )
                {
                    $result->push((new UserSelfKwdPvt)->create([
                        UserSelfKwdPvt::USER_ID => $authUser->getKey(),
                        UserSelfKwdPvt::KEYWORD_ID => $keyword->getKey()
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
