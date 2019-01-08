<?php

namespace Tests\Unit\App\Http\Controllers\Api\Keyword;

use App\Services\Keyword\StatureRange\MaxStatureRangeListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class MaxStatureRangeControllerTest extends _TestCase {

    public function testIndex()
    {
        $expands = $this->setInputParameter('expands');
        $fields  = $this->setInputParameter('fields');
        $min     = $this->setInputParameter('min');

        $this->assertReturn([MaxStatureRangeListingService::class, [
            'expands'
                => $expands,
            'fields'
                => $fields,
            'min'
                => $min,
        ], [
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'min'
                => '[min]',
        ]]);
    }

}