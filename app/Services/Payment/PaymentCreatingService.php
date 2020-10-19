<?php

namespace App\Services\Payment;

use App\Database\Models\Item;
use App\Database\Models\Payment;
use App\Service;
use App\Services\Item\ItemFindingService;
use App\Services\CreatingService;

class PaymentCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'created' => ['auth_user', 'item', 'payment_amount', 'payment_currency', function ($authUser, $item, $paymentAmount, $paymentCurrency) {

                return (new Payment)->create([
                    Payment::USER_ID
                        => $authUser->getKey(),
                    Payment::ITEM_ID
                        => $item->getKey(),
                    Payment::AMOUNT
                        => $paymentAmount,
                    Payment::CURRENCY
                        => $paymentCurrency
                ]);
            }],

            'item' => ['item_id', function ($itemId) {

                return [ItemFindingService::class, [
                    'id' => $itemId
                ], [
                    'id' => '{{item_id}}'
                ]];
            }],

            'item_amount' => ['item', function ($item) {

                return $item->{Item::FINAL_PRICE};
            }],

            'item_currency' => ['item', function ($item) {

                return $item->{Item::CURRENCY};
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
                => ['required'],

            'item_id'
                => ['required', 'integer'],

            'payment_amount'
                => ['required', 'same:{{item_amount}}'],

            'payment_currency'
                => ['required', 'same:{{item_currency}}']
        ];
    }

    public static function getArrTraits()
    {
        return [
            CreatingService::class
        ];
    }

}
