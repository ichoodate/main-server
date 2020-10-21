<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\CardGroup\CardGroupFindingService;
use App\Services\CardGroup\CardGroupListingService;
use App\Services\CardGroup\TodayCardGroupCreatingService;

class CardGroupControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser = $this->setAuthUser();
        $after    = $this->setInputParameter('after');
        $cursorId = $this->setInputParameter('cursor_id');
        $limit    = $this->setInputParameter('limit');
        $page     = $this->setInputParameter('page');
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $groupBy  = $this->setInputParameter('group_by');
        $orderBy  = $this->setInputParameter('order_by');
        $timezone = $this->setInputParameter('timezone');

        $this->assertReturn([CardGroupListingService::class, [
            'after'
                => $after,
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
                => '',
            'timezone'
                => $timezone,
        ], [
            'after'
                => '[after]',
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
                => '[order_by]',
            'timezone'
                => '[timezone]',
        ]]);
    }

    public function testShow()
    {
        $authUser = $this->setAuthUser();
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $id       = $this->setRouteParameter('card_group');

        $this->assertReturn([CardGroupFindingService::class, [
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
        $authUser = $this->setAuthUser();

        $this->assertReturn([TodayCardGroupCreatingService::class, [
            'auth_user'
                => $authUser,
        ], [
            'auth_user'
                => 'authorized user'
        ]]);
    }

}
