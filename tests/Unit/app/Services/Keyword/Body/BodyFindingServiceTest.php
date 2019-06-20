<?php

namespace Tests\Unit\App\Services\Keyword\Body;

use App\Database\Models\Keyword\Body;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class BodyFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'body keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', Body::class);
        });
    }

}
