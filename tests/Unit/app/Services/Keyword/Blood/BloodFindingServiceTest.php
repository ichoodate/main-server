<?php

namespace Tests\Unit\App\Services\Keyword\Blood;

use App\Database\Models\Keyword\Blood;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class BloodFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'blood keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', Blood::class);
        });
    }

}
