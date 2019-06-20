<?php

namespace Tests\Unit\App\Services\Keyword\Stature;

use App\Database\Models\Keyword\Stature;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class StatureFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'stature keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', Stature::class);
        });
    }

}
