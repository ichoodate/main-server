<?php

namespace Tests\Unit\App\Services\Reply;

use App\Database\Models\Ticket;
use App\Database\Models\Reply;
use App\Database\Models\User;
use App\Services\Ticket\TicketFindingService;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Services\_TestCase;

class ReplyCreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'ticket'
                => 'ticket of {{ticket_id}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'description'
                => ['required', 'string'],

            'ticket'
                => ['not_null'],

            'ticket_id'
                => ['required', 'integer'],
        ]);
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $authUser    = $this->factory(User::class)->make();
            $ticket      = $this->factory(Ticket::class)->make();
            $description = $this->uniqueString();
            $return      = $this->uniqueString();

            ModelMocker::create(Reply::class, [
                Reply::WRITER_ID   => $authUser->getKey(),
                Reply::DESCRIPTION => $description,
                Reply::TICKET_ID   => $ticket->getKey()
            ], $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('ticket', $ticket);
            $proxy->data->put('description', $description);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

    public function testLoaderTicket()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $ticketId = $this->uniqueString();
            $return   = [TicketFindingService::class, [
                'auth_user'
                    => $authUser,
                'id'
                    => $ticketId
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'id'
                    => '{{ticket_id}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('ticket_id', $ticketId);

            $this->verifyLoader($serv, 'ticket', $return);
        });

    }

}
