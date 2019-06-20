<?php

namespace App\Services\User;

use App\Database\Models\User;
use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\Obj;
use App\Service;
use App\Services\RandommingService;
use App\Services\Obj\KeywordObjListingService;

class MatchingUserRandommingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.keywords' => ['query', 'keywords', 'matching_gender', function ($query, $keywords, $matchingGender) {

                $nested = inst(User::class)->query()
                    ->qWhere(User::GENDER, $matchingGender)
                    ->getQuery();

                $sub = inst(UserSelfKwdPvt::class)->query()
                    ->qSelect(UserSelfKwdPvt::USER_ID)
                    ->qGroupBy(UserSelfKwdPvt::USER_ID)
                    ->qWhereIn(UserSelfKwdPvt::KEYWORD_ID, $keywords->modelKeys())
                    ->qWhereIn(UserSelfKwdPvt::USER_ID, $nested)
                    ->orderByRaw('count(*) desc')
                    ->limit(1000)
                    ->getQuery();

                $query
                    ->qWhereIn(User::ID, $sub)
                    ->orderByRaw('rand()');
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'keywords' => ['keyword_ids', function ($keywordIds) {

                $keywordIds = preg_split('/\s*,\s*/', $keywordIds);

                return inst(Obj::class)->query()
                    ->qWhereIn(Obj::ID, $keywordIds)
                    ->qWhereIn(Obj::TYPE, Obj::TYPE_KEYWORD_VALUES)
                    ->get()
                    ->sortByIds($keywordIds);
            }],

            'matching_gender' => ['auth_user', function ($authUser) {

                if ( $authUser->{User::GENDER} == User::GENDER_MAN )
                {
                    return User::GENDER_WOMAN;
                }
                else
                {
                    return User::GENDER_MAN;
                }
            }],

            'model_class' => [function () {

                return User::class;
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
                => ['required', 'integers'],

            'keywords.*'
                => ['not_null']
        ];
    }

    public static function getArrTraits()
    {
        return [
            RandommingService::class
        ];
    }

}
