<?php

namespace Tests\Unit\App\Http\Controllers\Api\Keyword;

use App\Database\Models\Keyword\AgeRange;
use App\Services\Keyword\AgeRange\AgeRangeFindingService;
use App\Services\Keyword\AgeRange\AgeRangeListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class AgeRangeControllerTest extends _TestCase {

    public function testShow()
    {
        $expands = $this->uniqueString();
        $fields  = $this->uniqueString();
        $id      = $this->uniqueString();

        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setRouteParameter('id', $id);

        $this->assertReturn([AgeRangeFindingService::class, [
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
