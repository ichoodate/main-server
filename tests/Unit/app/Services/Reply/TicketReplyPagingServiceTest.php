<?php

namespace Tests\Unit\App\Services\Reply;

use App\Database\Models\Reply;
use App\Database\Models\Ticket;
use App\Database\Models\User;
use App\Services\PagingService;
use App\Services\Reply\ReplyFindingService;
use App\Services\Ticket\TicketFindingService;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class TicketReplyPagingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'ticket'
                => 'ticket for {{ticket_id}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'ticket'
                => ['not_null'],

            'ticket_id'
                => ['required', 'integer']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            PagingService::class
        ]);
    }

    public function testCallbackQueryTicket()
    {
        $this->when(function ($proxy, $serv) {

            $query  = $this->mMock();
            $ticket = $this->factory(Ticket::class)->make();

            QueryMocker::qWhere($query, Reply::TICKET_ID, $ticket->getKey());

            $proxy->data->put('ticket', $ticket);
            $proxy->data->put('query', $query);

            $this->verifyCallback($serv, 'query.ticket');
        });
    }

    public function testLoaderCursor()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->uniqueString();
            $id       = $this->uniqueString();
            $return   = [ReplyFindingService::class, [
                'auth_user'
                    => $authUser,
                'id'
                    => $id
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'id'
                    => '{{id}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('id', $id);

            $this->verifyLoader($serv, 'cursor', $return);
        });
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
            $id       = $this->uniqueString();
            $return   = [TicketFindingService::class, [
                'auth_user'
                    => $authUser,
                'id'
                    => $id
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'id'
                    => '{{ticket_id}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('ticket_id', $id);

            $this->verifyLoader($serv, 'ticket', $return);
        });
    }

}
