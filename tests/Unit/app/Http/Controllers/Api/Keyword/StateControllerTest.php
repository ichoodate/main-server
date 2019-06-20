<?php

namespace Tests\Unit\App\Http\Controllers\Api\Keyword;

use App\Services\Keyword\State\StateFindingService;
use App\Services\Keyword\State\StateListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class StateControllerTest extends _TestCase {

    public function testIndex()
    {
        $countryId = $this->uniqueString();
        $expands   = $this->uniqueString();
        $fields    = $this->uniqueString();

        $this->setInputParameter('country_id', $countryId);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);

        $this->assertReturn([StateListingService::class, [
            'country_id'
                => $countryId,
            'expands'
                => $expands,
            'fields'
                => $fields,
            'group_by'
                => new \stdClass,
            'order_by'
                => new \stdClass
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
        $expands = $this->uniqueString();
        $fields  = $this->uniqueString();
        $id      = $this->uniqueString();

        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setRouteParameter('id', $id);

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
