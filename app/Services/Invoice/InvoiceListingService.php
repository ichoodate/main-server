<?php

namespace App\Services\Invoice;

use App\Database\Models\Invoice;
use Illuminate\Extend\Service;
use App\Services\LimitedListingService;
use App\Services\Invoice\InvoiceFindingService;

class InvoiceListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => ['query', 'auth_user', function ($query, $authUser) {

                $query->qWhere(Invoice::USER_ID, $authUser->getKey());
            }]
        ];
    }

     public static function getArrLoaders()
    {
        return [
            'available_expands' => [function () {

                return ['user'];
            }],

            'cursor' => ['auth_user', 'cursor_id', function ($authUser, $cursorId) {

                return [InvoiceFindingService::class, [
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

                return Invoice::class;
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
