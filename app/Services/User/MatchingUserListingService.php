<?php

namespace App\Services\User;

use App\Database\Models\User;
use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\Obj;
use Illuminate\Extend\Service;
use App\Services\RandommingService;
use App\Services\Obj\KeywordObjListingService;
use Illuminate\Support\Facades\DB;

class MatchingUserListingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'keywords.*'
                => 'keywords.* for {{keyword_ids}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.keywords' => function ($keywords='', $matchingGender, $query, $strict) {

                $nested = (new User)->query()
                    ->select(User::ID)
                    ->qWhere(User::GENDER, $matchingGender)
                    ->getQuery();

                $sub = (new UserSelfKwdPvt)->query()
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
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {

                return ['facePhoto', 'friend', 'match', 'match.cards.flips', 'popularity'];
            },

            'keywords' => function ($keywordIds) {

                $keywordIds = preg_split('/\s*,\s*/', $keywordIds);

                return (new Obj)->query()
                    ->qWhereIn(Obj::ID, $keywordIds)
                    ->qWhereIn(Obj::TYPE, Obj::TYPE_KEYWORD_VALUES)
                    ->get()
                    ->sortByIds($keywordIds);
            },

            'matching_gender' => function ($authUser) {

                if ( $authUser->{User::GENDER} == User::GENDER_MAN )
                {
                    return User::GENDER_WOMAN;
                }
                else
                {
                    return User::GENDER_MAN;
                }
            },

            'model_class' => function () {

                return User::class;
            },

            'strict' => function () {

                return false;
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
            RandommingService::class,
        ];
    }

}
