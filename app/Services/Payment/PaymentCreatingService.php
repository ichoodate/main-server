<?php

namespace App\Services\Payment;

use App\Models\Item;
use App\Models\Payment;
use App\Services\Item\ItemFindingService;
use FunctionalCoding\Service;

class PaymentCreatingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'created' => function ($authUser, $item, $paymentAmount, $paymentCurrency) {
                return (new Payment())->create([
                    Payment::USER_ID => $authUser->getKey(),
                    Payment::ITEM_ID => $item->getKey(),
                    Payment::AMOUNT => $paymentAmount,
                    Payment::CURRENCY => $paymentCurrency,
                ]);
            },

            'item' => function ($itemId) {
                return [ItemFindingService::class, [
                    'id' => $itemId,
                ], [
                    'id' => '{{item_id}}',
                ]];
            },

            'item_amount' => function ($item) {
                return $item->{Item::FINAL_PRICE};
            },

            'item_currency' => function ($item) {
                return $item->{Item::CURRENCY};
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

            'item_id' => ['required', 'integer'],

            'payment_amount' => ['required', 'same:{{item_amount}}'],

            'payment_currency' => ['required', 'same:{{item_currency}}'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
