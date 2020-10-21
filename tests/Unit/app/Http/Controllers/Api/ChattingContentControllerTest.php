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
        $authUser = $this->setAuthUser();
        $cursorId = $this->setInputParameter('cursor_id');
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $limit    = $this->setInputParameter('limit');
        $matchId  = $this->setInputParameter('match_id');
        $page     = $this->setInputParameter('page');

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
        $authUser = $this->setAuthUser();
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $id       = $this->setRouteParameter('chatting_content');

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
        $authUser = $this->setAuthUser();
        $matchId  = $this->setInputParameter('match_id');
        $message  = $this->setInputParameter('message');

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
