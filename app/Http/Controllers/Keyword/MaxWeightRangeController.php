<?php

namespace App\Http\Controllers\Keyword;

use App\Http\ControllersController;
use App\Services\Keyword\WeightRange\MaxWeightRangeListingService;

class MaxWeightRangeController extends ApiController
{
    public static function index()
    {
        return [MaxWeightRangeListingService::class, [
            'min' => static::input('min'),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
        ], [
            'min' => '[min]',
            'expands' => '[expands]',
            'fields' => '[fields]',
        ]];
    }
}
