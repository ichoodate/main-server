<?php

namespace Tests\Unit\App\Services\Keyword\StatureRange;

use App\Database\Models\Keyword\StatureRange;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class StatureRangeFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'stature_range keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', StatureRange::class);
        });
    }

}
