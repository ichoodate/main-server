<?php

namespace App\Services\User;

use App\Database\Models\User;
use App\Database\Models\Profilable;
use App\Database\Models\Obj;
use App\Service;
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

                $nested = inst(User::class)->aliasQuery()
                    ->qWhere(User::GENDER, $matchingGender)
                    ->getQuery();

                $sub = inst(Profilable::class)->aliasQuery()
                    ->qSelect(Profilable::USER_ID)
                    ->qGroupBy(Profilable::USER_ID)
                    ->qWhereIn(Profilable::KEYWORD_ID, $keywords->modelKeys())
                    ->qWhereIn(Profilable::USER_ID, $nested)
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

                return app(KeywordObjListingService::class, [[
                    'ids'
                        => $keywordIds
                ], [
                    'ids'
                        => '{{keyword_ids}}'
                ]]);
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
            'keyword_ids'
                => ['required', 'integers']
        ];
    }

    public static function getArrTraits()
    {
        return [
            AuthUserRequiringService::class,
            RandommingService::class
        ];
    }

}
