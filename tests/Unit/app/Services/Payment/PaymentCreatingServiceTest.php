<?php

namespace Tests\Unit\App\Services\Payment;

use App\Database\Models\Item;
use App\Database\Models\Payment;
use App\Database\Models\User;
use App\Services\Item\ItemFindingService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Services\_TestCase;

class PaymentCreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'item_id'
                => ['required', 'integer'],

            'payment_amount'
                => ['required', 'same:{{item_amount}}'],

            'payment_currency'
                => ['required', 'same:{{item_currency}}']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([]);
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $authUser        = $this->factory(User::class)->make();
            $item            = $this->factory(Item::class)->make();
            $return          = $this->uniqueString();
            $paymentAmount   = $this->uniqueString();
            $paymentCurrency = $this->uniqueString();

            ModelMocker::create(Payment::class, [
                Payment::USER_ID
                    => $authUser->getKey(),
                Payment::ITEM_ID
                    => $item->getKey(),
                Payment::AMOUNT
                    => $paymentAmount,
                Payment::CURRENCY
                    => $paymentCurrency
            ], $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('item', $item);
            $proxy->data->put('payment_amount', $paymentAmount);
            $proxy->data->put('payment_currency', $paymentCurrency);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

    public function testLoaderItem()
    {
        $this->when(function ($proxy, $serv) {

            $itemId = $this->uniqueString();
            $return = [ItemFindingService::class, [
                'id'
                    => $itemId
            ], [
                'id'
                    => '{{item_id}}'
            ]];

            $proxy->data->put('item_id', $itemId);

            $this->verifyLoader($serv, 'item', $return);
        });
    }

    public function testLoaderItemAmount()
    {
        $this->when(function ($proxy, $serv) {

            $item   = $this->factory(Item::class)->make();
            $return = $item->{Item::FINAL_PRICE};

            $proxy->data->put('item', $item);

            $this->verifyLoader($serv, 'item_amount', $return);
        });
    }

    public function testLoaderItemCurrency()
    {
        $this->when(function ($proxy, $serv) {

            $item   = $this->factory(Item::class)->make();
            $return = $item->{Item::CURRENCY};

            $proxy->data->put('item', $item);

            $this->verifyLoader($serv, 'item_currency', $return);
        });
    }

}
