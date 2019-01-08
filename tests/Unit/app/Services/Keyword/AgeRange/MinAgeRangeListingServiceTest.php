<?php

namespace Tests\Unit\App\Services\Keyword\AgeRange;

use App\Database\Models\Keyword\AgeRange;
use App\Services\ListingService;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class MinAgeRangeListingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'max'
                => ['required', 'integer']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            ListingService::class
        ]);
    }

    public function testCallbackQueryMin()
    {
        $this->when(function ($proxy, $serv) {

            $query = $this->mMock();
            $max   = $this->uniqueString();

            QueryMocker::qWhere($query, 'max', $max);

            $proxy->data->put('query', $query);
            $proxy->data->put('max', $max);

            $this->verifyCallback($serv, 'query.max');
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', AgeRange::class);
        });
    }

}
