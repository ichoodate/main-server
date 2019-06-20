<?php

namespace Tests\Unit\App\Services\Keyword\Residence;

use App\Database\Models\Keyword\Residence;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class ResidenceFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'residence keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', Residence::class);
        });
    }

}
