<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\Ticket\TicketCreatingService;
use App\Services\Ticket\TicketFindingService;
use App\Services\Ticket\TicketListingService;

class TicketControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser = $this->setAuthUser();
        $cursorId = $this->setInputParameter('cursor_id');
        $limit    = $this->setInputParameter('limit');
        $page     = $this->setInputParameter('page');
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $groupBy  = $this->setInputParameter('group_by');
        $orderBy  = $this->setInputParameter('order_by');

        $this->assertReturn([TicketListingService::class, [
            'auth_user'
                => $authUser,
            'cursor_id'
                => $cursorId,
            'limit'
                => $limit,
            'page'
                => $page,
            'expands'
                => $expands,
            'fields'
                => $fields,
            'group_by'
                => '',
            'order_by'
                => ''
        ], [
            'auth_user'
                => 'authorized user',
            'cursor_id'
                => '[cursor_id]',
            'limit'
                => '[limit]',
            'page'
                => '[page]',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'group_by'
                => '[group_by]',
            'order_by'
                => '[order_by]'
        ]]);
    }

    public function testShow()
    {
        $authUser = $this->setAuthUser();
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $id       = $this->setRouteParameter('ticket');

        $this->assertReturn([TicketFindingService::class, [
            'auth_user'
                => $authUser,
            'expands'
                => $expands,
            'fields'
                => $fields,
            'id'
                => $id
        ], [
            'auth_user'
                => 'authorized user',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'id'
                => $id
        ]]);
    }

    public function testStore()
    {
        $authUser    = $this->setAuthUser();
        $description = $this->setInputParameter('description');
        $subject     = $this->setInputParameter('subject');

        $this->assertReturn([TicketCreatingService::class, [
            'auth_user'
                => auth()->user(),
            'description'
                => $description,
            'subject'
                => $subject,
        ], [
            'auth_user'
                => 'authorized user',
            'description'
                => '[description]',
            'subject'
                => '[subject]',
        ]]);
    }
}
