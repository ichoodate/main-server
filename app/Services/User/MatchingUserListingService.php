<?php

namespace App\Services\User;

use App\Models\Obj;
use App\Models\User;
use App\Models\UserKeyword;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\ORM\Eloquent\Service\RandomListService;
use FunctionalCoding\Service;
use Illuminate\Support\Facades\DB;

class MatchingUserListingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'keywords' => 'keywords for {{keyword_ids}}',

            'keywords.*' => 'keywords.* for {{keyword_ids}}',
        ];
    }

    public static function getArrCallbacks()
    {
        return [
            'query.keywords' => function ($keywords = '', $matchingGender, $query, $strict) {
                $nestedQuery = (new User())->query()
                    ->select(User::ID)
                    ->where(User::GENDER, $matchingGender)
                    ->getQuery()
                ;

                $subQuery = (new UserKeyword())->query()
                    ->select(UserKeyword::USER_ID)
                    ->whereIn(UserKeyword::USER_ID, $nestedQuery)
                    ->groupBy(UserKeyword::USER_ID)
                    ->take(1000)
                    ->getQuery()
                ;

                if ($strict && $keywords) {
                    $count = count($keywords->modelKeys());
                    $subQuery->whereIn(UserKeyword::KEYWORD_ID, $keywords->modelKeys());
                    $subQuery->having(DB::raw('count(*)'), $count);
                } else if (!$strict) {
                    $subQuery->orderByRaw('count(*) desc');
                }

                $wrapQuery = app('db')->table($subQuery, 't')
                    ->select(UserKeyword::USER_ID)
                    ->orderByRaw('rand()')
                ;

                $query
                    ->whereIn(User::ID, $wrapQuery->get()->pluck(UserKeyword::USER_ID)->all())
                ;
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'auth_token' => $authToken,
                ], [
                    'auth_token' => '{{auth_token}}',
                ]];
            },

            'available_expands' => function () {
                return ['facePhoto', 'friend', 'match', 'match.cards.flips', 'popularity'];
            },

            'keywords' => function ($keywordIds='') {
                if ( $keywordIds ) {
                    $keywordIds = preg_split('/\s*,\s*/', $keywordIds);
                } else {
                    $keywordIds = [];
                }

                return (new Obj())->query()
                    ->whereIn(Obj::ID, $keywordIds)
                    ->whereIn(Obj::TYPE, Obj::TYPE_KEYWORD_VALUES)
                    ->get()
                    ->sortByIds($keywordIds)
                ;
            },

            'matching_gender' => function ($authUser) {
                if (User::GENDER_MAN == $authUser->{User::GENDER}) {
                    return User::GENDER_WOMAN;
                }

                return User::GENDER_MAN;
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
            'keyword_ids' => ['integers'],

            'keywords' => ['array'],

            'keywords.*' => ['not_null'],

            'strict' => ['boolean'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            RandomListService::class,
        ];
    }
}
