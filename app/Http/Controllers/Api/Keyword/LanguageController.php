<?php

namespace App\Http\Controllers\Api\Keyword;

use App\Http\Controllers\ApiController;
use App\Services\Keyword\Language\LanguageFindingService;
use App\Services\Keyword\Language\LanguageListingService;

class LanguageController extends ApiController {

    public static function index()
    {
        return [LanguageListingService::class, [
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
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
        ]];
    }

    public static function show()
    {
        return [LanguageFindingService::class, [
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'id'
                => request()->route()->parameters()[array_keys(request()->route()->parameters())[0]]
        ], [
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'id'
                => request()->route()->parameters()[array_keys(request()->route()->parameters())[0]]
        ]];
    }

}
