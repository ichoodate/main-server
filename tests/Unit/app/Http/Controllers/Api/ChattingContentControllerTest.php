<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\ChattingContent\ChattingContentFindingService;
use App\Services\ChattingContent\ChattingContentListingService;
use App\Services\ChattingContent\ChattingContentCreatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class ChattingContentControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser = $this->factory(User::class)->make();
        $cursorId = $this->uniqueString();
        $limit    = $this->uniqueString();
        $page     = $this->uniqueString();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $matchId  = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('cursor_id', $cursorId);
        $this->setInputParameter('limit', $limit);
        $this->setInputParameter('page', $page);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setInputParameter('match_id', $matchId);

        $this->assertReturn([ChattingContentListingService::class, [
            'auth_user'
                => $authUser,
            'match_id'
                => $matchId,
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
                => '[match_id]',
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
        $authUser = $this->factory(User::class)->make();;
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $id       = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setRouteParameter('chatting_content', $id);

        $this->assertReturn([ChattingContentFindingService::class, [
            'auth_user'
                => $authUser,
            'expands'
                => $expands,
            'fields'
                => $fields,
            'id'
                => $id,
        ], [
            'auth_user'
                => 'authorized user',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'id'
                => $id,
        ]]);
    }

    public function testStore()
    {
        $authUser = $this->factory(User::class)->make();
        $message  = $this->uniqueString();
        $matchId  = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('message', $message);
        $this->setInputParameter('match_id', $matchId);

        $this->assertReturn([ChattingContentCreatingService::class, [
            'auth_user'
                => $authUser,
            'match_id'
                => $matchId,
            'message'
                => $message
        ], [
            'auth_user'
                => 'authorized user',
            'match_id'
                => '[match_id]',
            'message'
                => '[message]'
        ]]);
    }

}
