<?php

namespace App\Services\Balance;

use App\Models\Balance;
use FunctionalCoding\Illuminate\Service\PaginationListService;
use FunctionalCoding\Service;

class BalanceListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => function ($authUser, $query) {
                $query->qWhere(Balance::USER_ID, $authUser->getKey());
            },
        ];
    }

    public static function getArrLoaders()
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

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user' => ['required'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
