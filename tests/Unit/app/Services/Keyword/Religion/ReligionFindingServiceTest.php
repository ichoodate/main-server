<?php

namespace Tests\Unit\App\Services\Keyword\Religion;

use App\Database\Models\Keyword\Religion;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class ReligionFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'religion keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', Religion::class);
        });
    }

}
