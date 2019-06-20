<?php

namespace Tests\Unit\App\Services;

use App\Database\Models\Activity;
use App\Database\Models\Balance;
use App\Database\Models\Coin;
use App\Database\Models\User;
use App\Services\NowTimezoneService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Collections\_Mocker as CollectionMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class UsedCoinAddingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'remain_coin'
                => 'coin total count own by {{auth_user}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'remain_coin'
                => ['integer', 'min:{{required_coin}}']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            NowTimezoneService::class
        ]);
    }

    public function testCallbackUsedCoins()
    {
        $this->when(function ($proxy, $serv) {

            $usedCoins = collect([
                $this->factory(Coin::class)->make([Coin::COUNT => -15]),
                $this->factory(Coin::class)->make([Coin::COUNT => -35])
            ]);
            $balances = collect([
                $this->mMock($this->factory(Balance::class)->make([Balance::COUNT => 100])),
                $this->mMock($this->factory(Balance::class)->make([Balance::COUNT => 200]))
            ]);

            $balances->get(0)->shouldReceive('setAttribute')->with(Balance::COUNT, 85)->ordered()->globally();
            $balances->get(0)->shouldReceive('save')->withNoArgs()->ordered()->globally();
            $balances->get(1)->shouldReceive('setAttribute')->with(Balance::COUNT, 165)->ordered()->globally();
            $balances->get(1)->shouldReceive('save')->withNoArgs()->ordered()->globally();

            $proxy->data->put('used_coins', $usedCoins);
            $proxy->data->put('balances', $balances);

            $this->verifyCallback($serv, 'used_coins');
        });
    }

    public function testLoaderBalances()
    {
        $this->when(function ($proxy, $serv) {

            $authUser        = $this->factory(User::class)->create();
            $nowTimezoneTime = $this->uniqueString();
            $query           = $this->mMock();
            $return          = $this->uniqueString();

            InstanceMocker::add(Balance::class, $inst = $this->mMock());
            ModelMocker::query($inst, $query);
            QueryMocker::qWhere($query, Balance::USER_ID, $authUser->getKey());
            QueryMocker::qWhereOp($query, Balance::DELETED_AT, '>=', $nowTimezoneTime);
            QueryMocker::qOrderBy($query, Balance::DELETED_AT . ' is null', 'asc');
            QueryMocker::qOrderBy($query, Balance::DELETED_AT, 'asc');
            QueryMocker::get($query, $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('now_timezone_time', $nowTimezoneTime);

            $this->verifyLoader($serv, 'balances', $return);
        });
    }

    public function testLoaderRemainCoin()
    {
        $this->when(function ($proxy, $serv) {

            $balances = $this->mMock();
            $return   = $this->uniqueString();

            $balances->shouldReceive('sum')->withArgs([Balance::COUNT])->andReturn($return);

            $proxy->data->put('balances', $balances);

            $this->verifyLoader($serv, 'remain_coin', $return);
        });
    }

    public function testLoaderRequiredCoin()
    {
        $this->when(function ($proxy, $serv) {

            $this->assertException(function () use ($serv) {

                $this->resolveLoader($serv, 'required_coin');
            });
        });
    }

    public function testLoaderUsedCoins()
    {
        $this->when(function ($proxy, $serv) {

            $coin1        = $this->mMock();
            $coin2        = $this->mMock();
            $model1       = $this->uniqueString();
            $model2       = $this->uniqueString();
            $authUser     = $this->factory(User::class)->make();
            $result       = $this->factory(Activity::class)->make();
            $requiredCoin = 150;
            $balances     = collect([
                $this->factory(Balance::class)->make([Balance::COUNT => 100]),
                $this->factory(Balance::class)->make([Balance::COUNT => 200]),
                $this->factory(Balance::class)->make([Balance::COUNT => 300])
            ]);
            $return       = $this->mMock();

            InstanceMocker::add(Coin::class, $inst = $this->mMock());
            ModelMocker::newCollection($inst, $return);
            InstanceMocker::add(Coin::class, $coin1);
            ModelMocker::create($coin1, [
                Coin::BALANCE_ID
                    => $balances->get(0)->getKey(),
                Coin::USER_ID
                    => $authUser->getKey(),
                Coin::RELATED_ID
                    => $result->getKey(),
                Coin::COUNT
                    => -100,
            ], $model1);
            InstanceMocker::add(Coin::class, $coin2);
            ModelMocker::create($coin2, [
                Coin::BALANCE_ID
                    => $balances->get(1)->getKey(),
                Coin::USER_ID
                    => $authUser->getKey(),
                Coin::RELATED_ID
                    => $result->getKey(),
                Coin::COUNT
                    => -50,
            ], $model2);

            CollectionMocker::push($return, $model1);
            CollectionMocker::push($return, $model2);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('required_coin', $requiredCoin);
            $proxy->data->put('result', $result);
            $proxy->data->put('balances', $balances);

            $this->verifyLoader($serv, 'used_coins', $return);
        });
    }

}
