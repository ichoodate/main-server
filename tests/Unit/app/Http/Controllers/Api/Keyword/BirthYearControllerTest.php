<?php

namespace Tests\Unit\App\Http\Controllers\Api\Keyword;

use App\Services\Keyword\BirthYear\BirthYearFindingService;
use App\Services\Keyword\BirthYear\BirthYearListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class BirthYearControllerTest extends _TestCase {

    public function testIndex()
    {
        $expands = $this->uniqueString();
        $fields  = $this->uniqueString();

        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);

        $this->assertReturn([BirthYearListingService::class, [
            'expands'
                => $expands,
            'fields'
                => $fields,
            'group_by'
                => '',
            'order_by'
                => ''
        ], [
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

        $this->assertReturn([BirthYearFindingService::class, [
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
