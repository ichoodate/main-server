<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\Ticket\TicketCreatingService;
use App\Services\Ticket\TicketFindingService;
use App\Services\Ticket\TicketPagingService;

class TicketControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser = $this->factory(User::class)->make();
        $cursorId = $this->uniqueString();
        $limit    = $this->uniqueString();
        $page     = $this->uniqueString();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $groupBy  = $this->uniqueString();
        $orderBy  = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('cursor_id', $cursorId);
        $this->setInputParameter('limit', $limit);
        $this->setInputParameter('page', $page);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setInputParameter('group_by', $groupBy);
        $this->setInputParameter('order_by', $orderBy);

        $this->assertReturn([TicketPagingService::class, [
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
        $authUser = $this->factory(User::class)->make();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $id       = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setRouteParameter('id', $id);

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
