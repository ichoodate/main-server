<?php

namespace App\Services\Subscription;

use App\Models\Subscription;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\ORM\Eloquent\Service\PaginationListService;
use FunctionalCoding\Service;

class SubscriptionListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => function ($authUser, $query) {
                $query->where(Subscription::USER_ID, $authUser->getKey());
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
                return ['payment', 'user'];
            },

            'cursor' => function ($authUser, $cursorId) {
                return [SubscriptionFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $cursorId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{cursor_id}}',
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
        return [];
    }

    public static function getArrTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
