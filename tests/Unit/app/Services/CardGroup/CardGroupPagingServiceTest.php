<?php

namespace Tests\Unit\App\Services\CardGroup;

use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Services\CardGroup\CardGroupPagingServiceTest as Serv;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class CardGroupPagingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

    public function testCallbackQueryAuthUser()
    {
        $this->when(function ($proxy, $serv) {

            $query       = $this->mMock();
            $authUser    = $this->factory(User::class)->make();

            QueryMocker::qWhere($query, CardGroup::USER_ID, $authUser->getKey());

            $proxy->data->put('query', $query);
            $proxy->data->put('auth_user', $authUser);

            $this->verifyCallback($serv, 'query.auth_user');
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', CardGroup::class);
        });
    }

}
