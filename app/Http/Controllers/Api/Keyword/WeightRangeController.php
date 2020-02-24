<?php

namespace App\Http\Controllers\Api\Keyword;

use App\Http\Controllers\ApiController;
use App\Services\Keyword\WeightRange\WeightRangeFindingService;
use App\Services\Keyword\WeightRange\WeightRangeListingService;

class WeightRangeController extends ApiController {

    public static function index()
    {
        return [WeightRangeListingService::class, [
            'max'
                => static::input('max'),
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
            'max'
                => '[max]',
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

    public static function show()
    {
        return [WeightRangeFindingService::class, [
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
