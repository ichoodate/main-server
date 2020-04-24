<?php

namespace App\Services\User;

use App\Database\Models\User;
use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\Obj;
use App\Service;
use App\Services\RandommingService;
use App\Services\Obj\KeywordObjListingService;
use Illuminate\Support\Facades\DB;

class MatchingUserRandommingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'keywords.*'
                => 'keyword for {{keyword_ids}}.*'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.keywords' => ['query', 'keywords', 'matching_gender', 'strict', function ($query, $keywords = '', $matchingGender, $strict) {

                $nested = inst(User::class)->query()
                    ->select(User::ID)
                    ->qWhere(User::GENDER, $matchingGender)
                    ->getQuery();

                $sub = inst(UserSelfKwdPvt::class)->query()
                    ->select(UserSelfKwdPvt::USER_ID)
                    ->qWhereIn(UserSelfKwdPvt::USER_ID, $nested)
                    ->qGroupBy(UserSelfKwdPvt::USER_ID);

                if ( $keywords )
                {
                    $count = count($keywords->modelKeys());
                    $sub->qWhereIn(UserSelfKwdPvt::KEYWORD_ID, $keywords->modelKeys());
                    $sub->take(1000);

                    if ( $strict )
                    {
                        $sub->having(DB::raw('count(*)'), $count);
                    }
                    else
                    {
                        $sub->orderByRaw('count(*) desc');
                    }
                }

                $query
                    ->qWhereIn(User::ID, $sub->getQuery()->get()->pluck(UserSelfKwdPvt::USER_ID)->all());
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
            }],

            'strict' => [function () {

                return false;
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
                => ['integers'],

            'keywords.*'
                => ['not_null'],

            'strict'
                => ['boolean']
        ];
    }

    public static function getArrTraits()
    {
        return [
            RandommingService::class
        ];
    }

}
