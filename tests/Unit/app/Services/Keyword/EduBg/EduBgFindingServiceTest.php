<?php

namespace Tests\Unit\App\Services\Keyword\EduBg;

use App\Database\Models\Keyword\EduBg;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class EduBgFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'education_background keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', EduBg::class);
        });
    }

}
