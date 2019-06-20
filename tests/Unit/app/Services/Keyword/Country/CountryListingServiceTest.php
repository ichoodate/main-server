<?php

namespace Tests\Unit\App\Services\Keyword\Country;

use App\Database\Models\Keyword\Country;
use App\Services\ListingService;
use App\Services\Keyword\CountryFindingService;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class CountryListingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'name'
                => ['string']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            ListingService::class
        ]);
    }

    public function testCallbackQueryName()
    {
        $this->when(function ($proxy, $serv) {

            $query = $this->mMock();
            $name  = $this->uniqueString();

            QueryMocker::qWhere($query, 'name', $name);

            $proxy->data->put('query', $query);
            $proxy->data->put('name', $name);

            $this->verifyCallback($serv, 'query.name');
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Country::class);
        });
    }

}
