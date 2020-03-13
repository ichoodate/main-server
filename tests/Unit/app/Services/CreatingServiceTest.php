<?php

namespace Tests\Unit\App\Services;

use App\Services\CardFlip\CardFlipCreatingService;
use Tests\Unit\App\Services\_TestCase;

class CreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([]);
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $this->assertException(function () use ($serv) {

                $this->resolveLoader($serv, 'created');
            });
        });
    }

    public function testLoaderResult()
    {
        $this->when(function ($proxy, $serv) {

            $created = $this->uniqueString();
            $return  = $created;

            $proxy->data->put('created', $created);

            $this->verifyLoader($serv, 'result', $return);
        });
    }

}
