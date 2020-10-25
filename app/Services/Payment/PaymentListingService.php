<?php

namespace App\Services\Payment;

use App\Database\Models\Payment;
use Illuminate\Extend\Service;
use App\Services\LimitedListingService;
use App\Services\Payment\PaymentFindingService;

class PaymentListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => ['query', 'auth_user', function ($query, $authUser) {

                $query->qWhere(Payment::USER_ID, $authUser->getKey());
            }]
        ];
    }

     public static function getArrLoaders()
    {
        return [
            'available_expands' => [function () {

                return ['item', 'user'];
            }],

            'cursor' => ['auth_user', 'cursor_id', function ($authUser, $cursorId) {

                return [PaymentFindingService::class, [
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

                return Payment::class;
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
