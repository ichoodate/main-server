<?php

namespace App\Services\UserSelfKwdPvt;

use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\Keyword\Hobby;
use App\Service;
use App\Services\ListingService;
use App\Services\Keyword\Hobby\HobbyFindingService;

class HobbyUserSelfKwdPvtUpdatingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'auth_user' => ['auth_user', function ($authUser) {

                $keywordIds = inst(Hobby::class)->query()
                    ->qSelect(Hobby::ID)
                    ->getQuery();

                inst(UserSelfKwdPvt::class)->query()
                    ->qWhere(UserSelfKwdPvt::USER_ID, $authUser->getKey())
                    ->qWhereIn(UserSelfKwdPvt::KEYWORD_ID, $keywordIds)
                    ->delete();
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'keywords' => ['keyword_ids', function ($keywordIds) {

                $keywordIds = preg_split('/\s*,\s*/', $keywordIds);

                return Hobby::query()
                    ->findMany($keywordIds)
                    ->sortByIds($keywordIds);
            }],

            'result' => ['auth_user', 'keywords', function ($authUser, $keywords) {

                $result = [];

                foreach ( $keywords as $keyword )
                {
                    $result[] = inst(UserSelfKwdPvt::class)->create([
                        UserSelfKwdPvt::USER_ID => $authUser->getKey(),
                        UserSelfKwdPvt::KEYWORD_ID => $keyword->getKey()
                    ]);
                }

                return $result;
            }]
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
                => ['required']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
