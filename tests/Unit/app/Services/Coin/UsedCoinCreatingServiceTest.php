<?php

namespace Tests\Unit\App\Services\Coin;

use App\Database\Models\Coin;
use App\Database\Models\User;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Services\_TestCase;

class UsedCoinCreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'count'
                => ['required', 'integer'],

            'remain_coin'
                => ['integer', 'min:{{remain_coin}}']
        ]);
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $coin     = $this->mMock();
            $authUser = $this->factory(User::class)->make();
            $count    = $this->uniqueString();
            $return   = $this->uniqueString();

            InstanceMocker::add(Coin::class, $coin);
            ModelMocker::create($coin, [
                Coin::USER_ID   => $authUser->getKey(),
                Coin::COUNT     => $count,
            ], $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('count', $count);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

    public function testLoaderRemainCoin()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'remain_coin', $authUser->{User::COIN});
        });
    }

}
