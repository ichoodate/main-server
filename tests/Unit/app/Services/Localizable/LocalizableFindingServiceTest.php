<?php

namespace Tests\Unit\App\Services\Localizable;

use App\Database\Models\Localizable;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class LocalizableFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'localizable for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', Localizable::class);
        });
    }

}
