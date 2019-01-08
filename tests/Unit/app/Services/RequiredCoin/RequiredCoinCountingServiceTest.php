<?php

namespace Tests\Unit\App\Services\RequiredCoin;

use Tests\Unit\App\Services\_TestCase;

class RequiredCoinCountingServiceTest extends _TestCase {

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

    public function testLoaderIsFree()
    {
        $this->when(function ($proxy, $serv) {

            $this->assertException(function () use ($serv) {

                $this->resolveLoader($serv, 'is_free');
            });
        });
    }

    public function testLoaderResult()
    {
        $this->when(function ($proxy, $serv) {

            $isFree = true;
            $price  = 45;
            $return = 0;

            $proxy->data->put('is_free', $isFree);
            $proxy->data->put('price', $price);

            $this->verifyLoader($serv, 'result', $return);
        });

        $this->when(function ($proxy, $serv) {

            $isFree = false;
            $price  = 45;
            $return = $price;

            $proxy->data->put('is_free', $isFree);
            $proxy->data->put('price', $price);

            $this->verifyLoader($serv, 'result', $return);
        });
    }

}
