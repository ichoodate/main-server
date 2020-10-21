<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Services\Notice\NoticeCreatingService;
use App\Services\Notice\NoticeFindingService;
use App\Services\Notice\NoticeListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class NoticeControllerTest extends _TestCase {

    public function testIndex()
    {
        $cursorId = $this->setInputParameter('cursor_id');
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $limit    = $this->setInputParameter('limit');
        $page     = $this->setInputParameter('page');

        $this->assertReturn([NoticeListingService::class, [
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
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $id       = $this->setRouteParameter('notice');

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

