<?php

namespace Tests\Unit\App\Services\Notice;

use App\Database\Models\Notice;
use App\Services\Notice\NoticesFindingService;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class NoticePagingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'type'
                => ['in:' . implode(',', Notice::TYPE_VALUES)]
        ]);
    }

    public function testCallbackQueryType()
    {
        $this->when(function ($proxy, $serv) {

            $query = $this->mMock();
            $type  = $this->uniqueString();

            QueryMocker::qWhere($query, Notice::TYPE, $type);

            $proxy->data->put('query', $query);
            $proxy->data->put('type', $type);

            $this->verifyCallback($serv, 'query.type');
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Notice::class);
        });
    }

}
