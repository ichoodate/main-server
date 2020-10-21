<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\Reply\TicketReplyCreatingService;
use App\Services\Reply\TicketReplyListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class TicketReplyControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser = $this->setAuthUser();
        $ticketId = $this->setRouteParameter('ticket');
        $cursorId = $this->setInputParameter('cursor_id');
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $limit    = $this->setInputParameter('limit');
        $page     = $this->setInputParameter('page');

        $this->assertReturn([TicketReplyListingService::class, [
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
                => '',
            'order_by'
                => ''
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
        $authUser    = $this->setAuthUser();
        $description = $this->setInputParameter('description');
        $ticketId    = $this->setRouteParameter('ticket');

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
