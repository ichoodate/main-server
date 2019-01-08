<?php

namespace Tests\Unit\App\Services\Reply;

use App\Database\Models\Ticket;
use App\Database\Models\Reply;
use App\Database\Models\User;
use App\Services\Ticket\TicketFindingService;
use Tests\Unit\App\Services\_TestCase;

class ReplyFindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'model'
                => 'reply of {{id}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Reply::class);
        });
    }

    public function testLoaderTicket()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $model    = $this->factory(Reply::class)->make();
            $return   = [TicketFindingService::class, [
                'auth_user'
                    => $authUser,
                'id'
                    => $model->{Reply::TICKET_ID}
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'id'
                    => 'ticket_id of {{model}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'ticket', $return);
        });
    }

}
