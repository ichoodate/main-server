<?php

namespace App\Http\Controllers\Api\Keyword;

use App\Http\Controllers\ApiController;
use App\Services\Keyword\AgeRange\MaxAgeRangeListingService;

class MaxAgeRangeController extends ApiController {

    public static function index()
    {
        return [MaxAgeRangeListingService::class, [
            'min'
                => static::input('min'),
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
        ], [
            'min'
                => '[min]',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
        ]];
    }

}
