<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\Invoice\InvoiceFindingService;
use App\Services\Invoice\InvoiceListingService;

class InvoiceControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser = $this->setAuthUser();
        $cursorId = $this->setInputParameter('cursor_id');
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $limit    = $this->setInputParameter('limit');
        $groupBy  = $this->setInputParameter('group_by');
        $orderBy  = $this->setInputParameter('order_by');
        $page     = $this->setInputParameter('page');

        $this->assertReturn([InvoiceListingService::class, [
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
        $id       = $this->setRouteParameter('invoice');

        $this->assertReturn([InvoiceFindingService::class, [
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
