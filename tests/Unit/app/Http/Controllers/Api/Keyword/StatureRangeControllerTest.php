<?php

namespace Tests\Unit\App\Http\Controllers\Api\Keyword;

use App\Database\Models\Keyword\StatureRange;
use App\Services\Keyword\StatureRange\StatureRangeFindingService;
use App\Services\Keyword\StatureRange\StatureRangeListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class StatureRangeControllerTest extends _TestCase {

    public function testShow()
    {
        $expands = $this->setInputParameter('expands');
        $fields  = $this->setInputParameter('fields');
        $id      = $this->setRouteParameter('id');

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
