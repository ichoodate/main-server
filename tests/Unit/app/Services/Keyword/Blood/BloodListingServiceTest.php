<?php

namespace Tests\Unit\App\Services\Keyword\Blood;

use App\Database\Models\Keyword\Blood;
use App\Services\ListingService;
use Tests\Unit\App\Services\_TestCase;

class BloodListingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            ListingService::class
        ]);
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Blood::class);
        });
    }

}
