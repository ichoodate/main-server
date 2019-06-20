<?php

namespace Tests\Unit\App\Services\Keyword\Country;

use App\Database\Models\Keyword\Country;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class CountryFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'country keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', Country::class);
        });
    }

}
