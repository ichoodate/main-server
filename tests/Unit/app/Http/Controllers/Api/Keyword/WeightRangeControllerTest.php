<?php

namespace Tests\Unit\App\Http\Controllers\Api\Keyword;

use App\Database\Models\Keyword\WeightRange;
use App\Services\Keyword\WeightRange\WeightRangeFindingService;
use App\Services\Keyword\WeightRange\WeightRangeListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class WeightRangeControllerTest extends _TestCase {

    public function testShow()
    {
        $expands = $this->setInputParameter('expands');
        $fields  = $this->setInputParameter('fields');
        $id      = $this->setRouteParameter('id');

        $this->assertReturn([WeightRangeFindingService::class, [
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
