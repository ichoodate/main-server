<?php

namespace Tests\Unit\App\Services;

use Tests\Unit\App\Services\_TestCase;
use Tests\Unit\App\Database\Collections\_Mocker as CollectionMocker;

class MergingServiceTest extends _TestCase {

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

    public function testLoaderExisted()
    {
        $this->when(function ($proxy, $serv) {

            $this->assertException(function () use ($serv) {

                $this->resolveLoader($serv, 'existed');
            });
        });
    }

    public function testLoaderResult()
    {
        $this->when(function ($proxy, $serv) {

            $created = $this->mMock();
            $existed = $this->mMock();
            $return  = $this->uniqueString();

            CollectionMocker::merge($created, $existed, $return);

            $proxy->data->put('created', $created);
            $proxy->data->put('existed', $existed);

            $this->verifyLoader($serv, 'result', $return);
        });
    }

}
