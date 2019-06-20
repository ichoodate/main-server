<?php

namespace Tests\Unit\App\Services\Keyword\Nationality;

use App\Database\Models\Keyword\Nationality;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class NationalityFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'nationality keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', Nationality::class);
        });
    }

}
