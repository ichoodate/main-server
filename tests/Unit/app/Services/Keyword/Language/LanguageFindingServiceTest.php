<?php

namespace Tests\Unit\App\Services\Keyword\Language;

use App\Database\Models\Keyword\Language;
use App\Services\FindingService;
use Tests\Unit\App\Services\_TestCase;

class LanguageFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'language keyword for {{id}}'
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

            $this->verifyLoader($serv, 'model_class', Language::class);
        });
    }

}
