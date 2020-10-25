<?php

namespace App\Services\Popularity;

use App\Database\Models\Popularity;
use Illuminate\Extend\Service;
use App\Services\LimitedListingService;
use App\Services\Popularity\PopularityFindingService;

class PopularityListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => ['query', 'auth_user', function ($query, $authUser) {

                $query->qWhere(Popularity::RECEIVER_ID, $authUser->getKey());
            }]
        ];
    }

     public static function getArrLoaders()
    {
        return [
            'available_expands' => [function () {

                return ['receiver', 'sender'];
            }],

            'cursor' => ['auth_user', 'cursor_id', function ($authUser, $cursorId) {

                return [PopularityFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $cursorId
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => '{{cursor_id}}'
                ]];
            }],

            'model_class' => [function () {

                return Popularity::class;
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
                => ['required']
        ];
    }

    public static function getArrTraits()
    {
        return [
            LimitedListingService::class
        ];
    }

}
