<?php

namespace Tests\Unit\App\Services\Keyword\Hobby;

use App\Database\Models\Keyword\Hobby;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class HobbyFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'hobby keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', Hobby::class);
        });
    }

}
