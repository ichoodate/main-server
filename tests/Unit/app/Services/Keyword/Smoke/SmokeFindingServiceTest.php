<?php

namespace Tests\Unit\App\Services\Keyword\Smoke;

use App\Database\Models\Keyword\Smoke;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class SmokeFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'smoke keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', Smoke::class);
        });
    }

}
