<?php

namespace Tests\Unit\App\Services;

use App\Services\Coin\UsedCoinCreatingService;
use Tests\Unit\App\Services\_TestCase;

class RequiredCoinExistingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
        ]);
    }

    public function testLoaderRequiredCoin()
    {
        $this->when(function ($proxy, $serv) {

            $this->assertException(function () use ($serv) {

                $this->resolveLoader($serv, 'required_coin');
            });
        });
    }

    public function testLoaderUsedCoin()
    {
        $this->when(function ($proxy, $serv) {

            $authUser     = $this->mMock();
            $requiredCoin = 1;
            $return       = [UsedCoinCreatingService::class, [
                'auth_user'
                    => $authUser,
                'count'
                    => $requiredCoin
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('required_coin', $requiredCoin);

            $this->verifyLoader($serv, 'used_coin', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser     = $this->mMock();
            $requiredCoin = 0;
            $return       = null;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('required_coin', $requiredCoin);

            $this->verifyLoader($serv, 'used_coin', $return);
        });
    }

}
