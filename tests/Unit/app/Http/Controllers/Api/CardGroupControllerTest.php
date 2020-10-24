<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\CardGroup\CardGroupFindingService;
use App\Services\CardGroup\CardGroupListingService;
use App\Services\CardGroup\TodayCardGroupCreatingService;

class CardGroupControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser = $this->factory(User::class)->make();
        $after    = $this->uniqueString();
        $cursorId = $this->uniqueString();
        $limit    = $this->uniqueString();
        $page     = $this->uniqueString();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $groupBy  = $this->uniqueString();
        $orderBy  = $this->uniqueString();
        $timezone = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('after', $after);
        $this->setInputParameter('cursor_id', $cursorId);
        $this->setInputParameter('limit', $limit);
        $this->setInputParameter('page', $page);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setInputParameter('group_by', $groupBy);
        $this->setInputParameter('order_by', $orderBy);
        $this->setInputParameter('timezone', $timezone);

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
        $authUser = $this->factory(User::class)->make();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $id       = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setRouteParameter('card-group', $id);

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
