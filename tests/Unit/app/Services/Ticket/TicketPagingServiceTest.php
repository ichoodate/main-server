<?php

namespace Tests\Unit\App\Services\Ticket;

use App\Database\Models\Ticket;
use App\Database\Models\User;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class TicketPagingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testCallbackQueryAuthUser()
    {
        $this->when(function ($proxy, $serv) {

            $query       = $this->mMock();
            $authUser    = $this->factory(User::class)->make();

            QueryMocker::qWhere($query, Ticket::WRITER_ID, $authUser->getKey());

            $proxy->data->put('query', $query);
            $proxy->data->put('auth_user', $authUser);

            $this->verifyCallback($serv, 'query.auth_user');
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Ticket::class);
        });
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

}
