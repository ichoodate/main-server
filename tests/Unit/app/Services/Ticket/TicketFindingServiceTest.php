<?php

namespace Tests\Unit\App\Services\Ticket;

use App\Database\Models\Ticket;
use Tests\Unit\App\Services\_TestCase;

class TicketFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'ticket of {{id}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Ticket::class);
        });
    }

    public function testLoaderPermittedUser()
    {
        $this->when(function ($proxy, $serv) {

            $authUser  = $this->factory(User::class)->make();
            $model     = $this->factory(Ticket::class)->make();
            $adminRole = $this->uniqueString();
            $return    = $authUser;

            $proxy->data->put('admin_role', $adminRole);
            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser  = $this->factory(User::class)->make();
            $model     = $this->factory(Ticket::class)->make([Ticket::WRITER_ID => $authUser->getKey()]);
            $adminRole = null;
            $return    = $authUser;

            $proxy->data->put('admin_role', $adminRole);
            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'permitted_user', $return);
        });
    }

}
