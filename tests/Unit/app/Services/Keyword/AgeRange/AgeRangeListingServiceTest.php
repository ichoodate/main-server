<?php

namespace Tests\Unit\App\Services\Keyword\AgeRange;

use App\Database\Models\Keyword\AgeRange;
use App\Services\ListingService;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class AgeRangeListingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'min'
                => ['integer']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            ListingService::class
        ]);
    }

    public function testCallbackQuery()
    {
        $this->when(function ($proxy, $serv) {

            $query = $this->mMock();

            QueryMocker::qGroupBy($query, ['max']);
            QueryMocker::qOrderBy($query, 'max', 'asc');

            $proxy->data->put('query', $query);

            $this->verifyCallback($serv, 'query');
        });
    }

    public function testCallbackQueryMin()
    {
        $this->when(function ($proxy, $serv) {

            $query = $this->mMock();
            $min   = $this->uniqueString();

            QueryMocker::qWhere($query, 'min', $min);

            $proxy->data->put('query', $query);
            $proxy->data->put('min', $min);

            $this->verifyCallback($serv, 'query.min');
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', AgeRange::class);
        });
    }

}
