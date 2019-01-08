<?php

namespace Tests\Unit\App\Http\Controllers\Api\Keyword;

use App\Services\Keyword\AgeRange\MaxAgeRangeListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class MaxAgeRangeControllerTest extends _TestCase {

    public function testIndex()
    {
        $expands = $this->setInputParameter('expands');
        $fields  = $this->setInputParameter('fields');
        $min     = $this->setInputParameter('min');

        $this->assertReturn([MaxAgeRangeListingService::class, [
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