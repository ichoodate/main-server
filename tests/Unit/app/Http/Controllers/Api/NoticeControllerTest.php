<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Services\Notice\NoticeCreatingService;
use App\Services\Notice\NoticeFindingService;
use App\Services\Notice\NoticePagingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class NoticeControllerTest extends _TestCase {

    public function testIndex()
    {
        $cursorId = $this->uniqueString();
        $limit    = $this->uniqueString();
        $page     = $this->uniqueString();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();

        $this->setInputParameter('cursor_id', $cursorId);
        $this->setInputParameter('limit', $limit);
        $this->setInputParameter('page', $page);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);

        $this->assertReturn([NoticePagingService::class, [
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
                => new \stdClass,
            'order_by'
                => new \stdClass
        ], [
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
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $id       = $this->uniqueString();

        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setRouteParameter('id', $id);

        $this->assertReturn([NoticeFindingService::class, [
            'expands'
                => $expands,
            'fields'
                => $fields,
            'id'
                => $id
        ], [
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
        $type        = $this->setInputParameter('type');

        $this->assertReturn([NoticeCreatingService::class, [
            'auth_user'
                => $authUser,
            'description'
                => $description,
            'subject'
                => $subject,
            'type'
                => $type,
        ], [
            'auth_user'
                => 'authorized user',
            'description'
                => '[description]',
            'subject'
                => '[subject]',
            'type'
                => '[type]',
        ]]);
    }

}

