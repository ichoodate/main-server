<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\WeightRange\MaxWeightRangeListingService;

class MaxWeightRangeController extends Controller
{
    public static function index()
    {
        return [MaxWeightRangeListingService::class, [
            'min' => static::input('min'),
        ], [
            'min' => '[min]',
        ]];
    }
}
