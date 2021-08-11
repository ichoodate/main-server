<?php

namespace App\Services\Invoice;

use App\Models\Invoice;
use FunctionalCoding\Illuminate\Service\PaginationListService;
use FunctionalCoding\Service;

class InvoiceListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => function ($authUser, $query) {
                $query->qWhere(Invoice::USER_ID, $authUser->getKey());
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
                return [InvoiceFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $cursorId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{cursor_id}}',
                ]];
            },

            'model_class' => function () {
                return Invoice::class;
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
