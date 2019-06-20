<?php

namespace Tests\Unit\App\Services\Keyword\WeightRange;

use App\Database\Models\Keyword\WeightRange;
use App\Services\ListingService;
use Tests\Unit\App\Services\_TestCase;

class WeightRangeListingServiceTest extends _TestCase {

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

            $this->verifyLoader($serv, 'model_class', WeightRange::class);
        });
    }

}
