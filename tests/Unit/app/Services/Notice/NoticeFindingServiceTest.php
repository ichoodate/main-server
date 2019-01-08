<?php

namespace Tests\Unit\App\Services\Notice;

use App\Database\Models\Notice;
use Tests\Unit\App\Services\_TestCase;

class NoticeFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'notice of {{id}}'
         ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Notice::class);
        });
    }

}
