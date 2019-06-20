<?php

namespace Tests\Unit\App\Services\Item;

use App\Database\Models\Item;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class ItemFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'item for {{id}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            FindingService::class
        ]);
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Item::class);
        });
    }

}
