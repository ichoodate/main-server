<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\ChattingContent\MatchChattingContentPagingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class MatchChattingContentControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser = $this->factory(User::class)->make();
        $cursorId = $this->uniqueString();
        $limit    = $this->uniqueString();
        $page     = $this->uniqueString();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $id       = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('cursor_id', $cursorId);
        $this->setInputParameter('limit', $limit);
        $this->setInputParameter('page', $page);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setRouteParameter('id', $id);

        $this->assertReturn([MatchChattingContentPagingService::class, [
            'auth_user'
                => $authUser,
            'match_id'
                => $id,
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
            'match_id'
                => $id,
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

    public function testStore()
    {
        $authUser = $this->factory(User::class)->make();
        $message  = $this->uniqueString();
        $id       = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('message', $message);
        $this->setRouteParameter('id', $id);

        $this->assertReturn([MatchChattingContentPagingService::class, [
            'auth_user'
                => $authUser,
            'match_id'
                => $id,
            'message'
                => $message
        ], [
            'auth_user'
                => 'authorized user',
            'match_id'
                => $id,
            'message'
                => '[message]'
        ]]);
    }

}
