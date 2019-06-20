<?php

namespace Tests\Unit\App\Services\Keyword\AgeRange;

use App\Database\Models\Keyword\AgeRange;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class AgeRangeFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'age_range keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', AgeRange::class);
        });
    }

}
