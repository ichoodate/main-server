<?php

namespace Tests\Unit\App\Http\Controllers\Api\Keyword;

use App\Services\Keyword\Career\CareerFindingService;
use App\Services\Keyword\Career\CareerListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class CareerControllerTest extends _TestCase {

    public function testIndex()
    {
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $parentId = $this->uniqueString();

        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setInputParameter('parent_id', $parentId);

        $this->assertReturn([CareerListingService::class, [
            'expands'
                => $expands,
            'fields'
                => $fields,
            'parent_id'
                => $parentId,
            'group_by'
                => '',
            'order_by'
                => ''
        ], [
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'parent_id'
                => '[parent_id]',
            'group_by'
                => '[group_by]',
            'order_by'
                => '[order_by]'
        ]]);
    }

    public function testShow()
    {
        $expands = $this->uniqueString();
        $fields  = $this->uniqueString();
        $id      = $this->uniqueString();

        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setRouteParameter('id', $id);

        $this->assertReturn([CareerFindingService::class, [
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

}
