<?php

namespace Tests\Unit\App\Services\Keyword\State;

use App\Database\Models\Keyword\State;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class StateFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'state keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', State::class);
        });
    }

}
