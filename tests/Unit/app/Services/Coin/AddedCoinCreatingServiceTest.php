<?php

namespace Tests\Unit\App\Services\Coin;

use App\Database\Models\Coin;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Services\_TestCase;

class AddedCoinCreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'count' => ['required', 'integer']
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

}
