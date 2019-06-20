<?php

namespace Tests\Unit\App\Services\Keyword\State;

use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\State;
use App\Services\ListingService;
use App\Services\Keyword\StateFindingService;
use Tests\Unit\App\Services\_TestCase;

class StateListingServiceTest extends _TestCase {

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

    public function testCallbackQueryCountry()
    {
        $this->when(function ($proxy, $serv) {

            $query   = $this->mMock();
            $country = $this->factory(Country::class)->make();

            QueryMocker::qWhere($query, State::COUNTRY_ID, $country->getKey());

            $proxy->data->put('query', $query);
            $proxy->data->put('country', $country);

            $this->verifyCallback($serv, 'query.country');
        });
    }

    public function testLoaderCursor()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->uniqueString();
            $id       = $this->uniqueString();
            $return   = [StateFindingService::class, [
                'id'
                    => $id
            ], [
                'id'
                    => '{{id}}'
            ]];

            $proxy->data->put('id', $id);

            $this->verifyLoader($serv, 'cursor', $return);
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', State::class);
        });
    }

}
