<?php

namespace Tests\Unit\App\Http\Controllers\Api\Keyword;

use App\Services\Keyword\WeightRange\MinWeightRangeListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class MinWeightRangeControllerTest extends _TestCase {

    public function testIndex()
    {
        $expands = $this->setInputParameter('expands');
        $fields  = $this->setInputParameter('fields');
        $max     = $this->setInputParameter('max');

        $this->assertReturn([MinWeightRangeListingService::class, [
            'expands'
                => $expands,
            'fields'
                => $fields,
            'max'
                => $max,
        ], [
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'max'
                => '[max]',
        ]]);
    }

}