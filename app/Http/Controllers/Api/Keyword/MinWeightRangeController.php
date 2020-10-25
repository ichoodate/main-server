<?php

namespace App\Http\Controllers\Api\Keyword;

use App\Http\Controllers\ApiController;
use App\Services\Keyword\WeightRange\MinWeightRangeListingService;

class MinWeightRangeController extends ApiController {

    public static function index()
    {
        return [MinWeightRangeListingService::class, [
            'max'
                => static::input('max'),
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
        ], [
            'max'
                => '[max]',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
        ]];
    }

}
