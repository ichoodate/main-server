<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\Popularity\PopularityCreatingService;
use App\Services\Popularity\PopularityFindingService;
use App\Services\Popularity\PopularityListingService;

class PopularityControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser = $this->setAuthUser();
        $cursorId = $this->setInputParameter('cursor_id');
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $limit    = $this->setInputParameter('limit');
        $page     = $this->setInputParameter('page');

        $this->assertReturn([PopularityListingService::class, [
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
        $id       = $this->setRouteParameter('popularity');

        $this->assertReturn([PopularityFindingService::class, [
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
        $point    = $this->setInputParameter('point');
        $userId   = $this->setInputParameter('user_id');

        $this->assertReturn([PopularityCreatingService::class, [
            'auth_user'
                => auth()->user(),
            'point'
                => $point,
            'user_id'
                => $userId,
        ], [
            'auth_user'
                => 'authorized user',
            'point'
                => '[point]',
            'user_id'
                => '[user_id]',
        ]]);
    }
}
