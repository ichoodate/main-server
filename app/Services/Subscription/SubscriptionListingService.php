<?php

namespace App\Services\Subscription;

use App\Models\Subscription;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\ORM\Eloquent\Service\PaginationListService;
use FunctionalCoding\Service;

class SubscriptionListingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'query.auth_user' => function ($authUser, $query) {
                $query->where(Subscription::USER_ID, $authUser->getKey());
            },
        ];
    }

    public static function getLoaders()
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

            'cursor' => function ($authToken, $cursorId) {
                return [SubscriptionFindingService::class, [
                    'auth_token' => $authToken,
                    'id' => $cursorId,
                ], [
                    'auth_token' => '{{auth_token}}',
                    'id' => '{{cursor_id}}',
                ]];
            },

            'model_class' => function () {
                return Subscription::class;
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [];
    }

    public static function getTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
