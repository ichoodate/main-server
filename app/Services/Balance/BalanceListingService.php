<?php

namespace App\Services\Balance;

use App\Models\Balance;
use FunctionalCoding\ORM\Eloquent\Service\PaginationListService;
use FunctionalCoding\Service;

class BalanceListingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'query.auth_user' => function ($authUser, $query) {
                $query->where(Balance::USER_ID, $authUser->getKey());
            },
        ];
    }

    public static function getLoaders()
    {
        return [
            'available_expands' => function () {
                return ['user'];
            },

            'cursor' => function ($authUser, $cursorId) {
                return [BalanceFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $cursorId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{cursor_id}}',
                ]];
            },

            'model_class' => function () {
                return Balance::class;
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'auth_user' => ['required'],
        ];
    }

    public static function getTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
