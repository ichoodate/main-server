<?php

namespace Tests\Unit\App\Http\Controllers\Api\Keyword;

use App\Services\Keyword\State\StateFindingService;
use App\Services\Keyword\State\StateListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class StateControllerTest extends _TestCase {

    public function testIndex()
    {
        $countryId = $this->setInputParameter('country_id');
        $expands   = $this->setInputParameter('expands');
        $fields    = $this->setInputParameter('fields');

        $this->assertReturn([StateListingService::class, [
            'country_id'
                => $countryId,
            'expands'
                => $expands,
            'fields'
                => $fields,
            'group_by'
                => '',
            'order_by'
                => ''
        ], [
            'country_id'
                => '[country_id]',
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

        $this->assertReturn([StateFindingService::class, [
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
