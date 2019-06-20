<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\Reply\TicketReplyCreatingService;
use App\Services\Reply\TicketReplyPagingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class TicketReplyControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser = $this->factory(User::class)->make();
        $ticketId = $this->uniqueString();
        $cursorId = $this->uniqueString();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $limit    = $this->uniqueString();
        $page     = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setRouteParameter('ticket', $ticketId);
        $this->setInputParameter('cursorId', $cursorId);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setInputParameter('limit', $limit);
        $this->setInputParameter('page', $page);

        $this->assertReturn([TicketReplyPagingService::class, [
            'auth_user'
                => $authUser,
            'ticket_id'
                => $ticketId,
            'cursor_id'
                => $cursorId,
            'expands'
                => $expands,
            'fields'
                => $fields,
            'limit'
                => $limit,
            'page'
                => $page,
            'group_by'
                => new \stdClass,
            'order_by'
                => new \stdClass
        ], [
            'auth_user'
                => 'authorized user',
            'ticket_id'
                => $ticketId,
            'cursor_id'
                => '[cursor_id]',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'limit'
                => '[limit]',
            'page'
                => '[page]',
            'group_by'
                => '[group_by]',
            'order_by'
                => '[order_by]'
        ]]);
    }

    public function testStore()
    {
        $authUser    = $this->factory(User::class)->make();
        $description = $this->uniqueString();
        $ticketId    = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('description', $expands);
        $this->setRouteParameter('ticket', $ticketId);

        $this->assertReturn([TicketReplyCreatingService::class, [
            'auth_user'
                => $authUser,
            'description'
                => $description,
            'ticket_id'
                => $ticketId
        ], [
            'auth_user'
                => 'authorized user',
            'description'
                => '[description]',
            'ticket_id'
                => $ticketId,
        ]]);
    }
}
