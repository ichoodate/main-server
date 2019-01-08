<?php

namespace App\Services\Activity;

use App\Database\Models\Activity;
use App\Database\Models\Match;
use App\Services\Match\MatchFindingService;
use App\Services\ListingService;
use App\Service;

class MatchActivityListingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'match'
                => 'match for {{match_id}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.match' => ['query', 'match', function ($query, $match) {

                $query->qWhere(Activity::RELATED_ID, $match->{Match::ID});
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'match' => ['auth_user', 'match_id', function ($authUser, $matchId) {

                return [MatchFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $matchId
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => '{{match_id}}'
                ]];
            }],

            'model_class' => [function () {

                return Activity::class;
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
            'match_id'
                => ['required', 'integer']
        ];
    }

    public static function getArrTraits()
    {
        return [
            AuthUserRequiringService::class,
            ListingService::class
        ];
    }

}
