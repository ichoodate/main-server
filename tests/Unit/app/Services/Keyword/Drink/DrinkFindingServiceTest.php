<?php

namespace Tests\Unit\App\Services\Keyword\Drink;

use App\Database\Models\Keyword\Drink;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class DrinkFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'drink keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', Drink::class);
        });
    }

}
