<?php

namespace Tests\Unit\App\Services\Keyword\BirthYear;

use App\Database\Models\Keyword\BirthYear;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class BirthYearFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'birth_year keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', BirthYear::class);
        });
    }

}
