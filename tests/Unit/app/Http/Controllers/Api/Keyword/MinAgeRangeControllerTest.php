<?php

namespace Tests\Unit\App\Http\Controllers\Api\Keyword;

use App\Services\Keyword\AgeRange\MinAgeRangeListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class MinAgeRangeControllerTest extends _TestCase {

    public function testIndex()
    {
        $expands = $this->setInputParameter('expands');
        $fields  = $this->setInputParameter('fields');
        $max     = $this->setInputParameter('max');

        $this->assertReturn([MinAgeRangeListingService::class, [
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