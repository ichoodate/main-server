<?php

namespace App\Http\Controllers\Api\Keyword;

use App\Http\Controllers\ApiController;
use App\Services\Keyword\StatureRange\StatureRangeFindingService;
use App\Services\Keyword\StatureRange\StatureRangeListingService;

class StatureRangeController extends ApiController {

    public static function show()
    {
        return [StatureRangeFindingService::class, [
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
