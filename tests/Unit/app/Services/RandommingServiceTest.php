<?php

namespace Tests\Unit\App\Services;

use Tests\Unit\App\Services\_TestCase;

class RandommingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'limit' => ['integer', 'max:100']
        ]);
    }

    public function testCallbackQueryLimit()
    {
        $this->when(function ($proxy, $serv) {

            $limit = $this->uniqueString();
            $query = $this->mMock();

            $query->shouldReceive('take')->with($limit)->once();

            $proxy->data->put('query', $query);
            $proxy->data->put('limit', $limit);

            $this->verifyCallback($serv, 'query.limit');
        });
    }

    public function testLoaderLimit()
    {
        $this->when(function ($proxy, $serv) {

            $return = 12;

            $this->verifyLoader($serv, 'limit', $return);
        });
    }

}
