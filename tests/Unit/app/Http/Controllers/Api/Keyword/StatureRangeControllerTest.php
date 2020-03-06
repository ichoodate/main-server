<?php

namespace Tests\Unit\App\Http\Controllers\Api\Keyword;

use App\Database\Models\Keyword\StatureRange;
use App\Services\Keyword\StatureRange\StatureRangeFindingService;
use App\Services\Keyword\StatureRange\StatureRangeListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class StatureRangeControllerTest extends _TestCase {

    public function testIndex()
    {
        $min     = $this->uniqueString();
        $expands = $this->uniqueString();
        $fields  = $this->uniqueString();

        $this->setInputParameter('min', $min);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);

        $this->assertReturn([StatureRangeListingService::class, [
            'min'
                => $min,
            'expands'
                => $expands,
            'fields'
                => $fields,
            'group_by'
                => '',
            'order_by'
                => ''
        ], [
            'min'
                => '[min]',
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
        $expands = $this->uniqueString();
        $fields  = $this->uniqueString();
        $id      = $this->uniqueString();

        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setRouteParameter('id', $id);

        $this->assertReturn([StatureRangeFindingService::class, [
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
