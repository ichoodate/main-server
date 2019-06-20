<?php

namespace Tests\Unit\App\Services\Keyword\Career;

use App\Database\Models\Keyword\Career;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class CareerFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'career keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', Career::class);
        });
    }

}
