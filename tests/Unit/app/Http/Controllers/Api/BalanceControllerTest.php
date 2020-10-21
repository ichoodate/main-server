<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\Balance\BalanceFindingService;
use App\Services\Balance\BalanceListingService;

class BalanceControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser = $this->setAuthUser();
        $cursorId = $this->setInputParameter('cursor_id');
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $limit    = $this->setInputParameter('limit');
        $orderBy  = $this->setInputParameter('order_by');
        $groupBy  = $this->setInputParameter('group_by');
        $page     = $this->setInputParameter('page');

        $this->assertReturn([BalanceListingService::class, [
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
        $id       = $this->setRouteParameter('balance');

        $this->assertReturn([BalanceFindingService::class, [
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

}
