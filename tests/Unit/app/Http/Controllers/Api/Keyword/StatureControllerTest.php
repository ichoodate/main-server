<?php

namespace Tests\Unit\App\Http\Controllers\Api\Keyword;

use App\Services\Keyword\Stature\StatureFindingService;
use App\Services\Keyword\Stature\StatureListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class StatureControllerTest extends _TestCase {

    public function testIndex()
    {
        $expands = $this->setInputParameter('expands');
        $fields  = $this->setInputParameter('fields');

        $this->assertReturn([StatureListingService::class, [
            'expands'
                => $expands,
            'fields'
                => $fields,
            'group_by'
                => '',
            'order_by'
                => ''
        ], [
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
        $expands = $this->setInputParameter('expands');
        $fields  = $this->setInputParameter('fields');
        $id      = $this->setRouteParameter('id');

        $this->assertReturn([StatureFindingService::class, [
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
