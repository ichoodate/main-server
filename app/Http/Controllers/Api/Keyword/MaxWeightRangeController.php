<?php

namespace App\Http\Controllers\Api\Keyword;

use App\Http\Controllers\ApiController;
use App\Services\Keyword\WeightRange\MaxWeightRangeListingService;

class MaxWeightRangeController extends ApiController {

    public static function index()
    {
        return [MaxWeightRangeListingService::class, [
            'min'
                => static::input('min'),
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'group_by'
                => new \stdClass,
            'order_by'
                => new \stdClass
        ], [
            'min'
                => '[min]',
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

}
