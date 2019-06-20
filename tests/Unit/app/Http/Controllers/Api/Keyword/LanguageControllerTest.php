<?php

namespace Tests\Unit\App\Http\Controllers\Api\Keyword;

use App\Services\Keyword\Language\LanguageFindingService;
use App\Services\Keyword\Language\LanguageListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class LanguageControllerTest extends _TestCase {

    public function testIndex()
    {
        $expands = $this->uniqueString();
        $fields  = $this->uniqueString();

        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);

        $this->assertReturn([LanguageListingService::class, [
            'expands'
                => $expands,
            'fields'
                => $fields,
            'group_by'
                => new \stdClass,
            'order_by'
                => new \stdClass
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

        $this->assertReturn([LanguageFindingService::class, [
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
