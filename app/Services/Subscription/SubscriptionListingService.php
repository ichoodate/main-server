<?php

namespace App\Services\Subscription;

use App\Database\Models\Subscription;
use App\Database\Models\User;
use Illuminate\Extend\Service;
use App\Services\LimitedListingService;
use App\Services\Subscription\SubscriptionFindingService;

class SubscriptionListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => function ($authUser, $query) {

                $query->qWhere(Subscription::USER_ID, $authUser->getKey());
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {

                return ['payment', 'user'];
            },

            'cursor' => function ($authUser, $cursorId) {

                return [SubscriptionFindingService::class, [
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
            },

            'model_class' => function () {

                return Subscription::class;
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
                => ['required']
        ];
    }

    public static function getArrTraits()
    {
        return [
            LimitedListingService::class,
        ];
    }

}
