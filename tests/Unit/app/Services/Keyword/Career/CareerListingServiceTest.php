<?php

namespace Tests\Unit\App\Services\Keyword\Career;

use App\Database\Models\Keyword\Career;
use App\Services\ListingService;
use Tests\Unit\App\Services\_TestCase;

class CareerListingServiceTest extends _TestCase {

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

    public function testCallbackQueryParentId()
    {
        $this->when(function ($proxy, $serv) {

            $query    = $this->mMock();
            $parentId = $this->uniqueString();

            QueryMocker::qWhere($query, 'parent_id', $parentId);

            $proxy->data->put('query', $query);
            $proxy->data->put('parent_id', $parentId);

            $this->verifyCallback($serv, 'query.parent_id');
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Career::class);
        });
    }

}
