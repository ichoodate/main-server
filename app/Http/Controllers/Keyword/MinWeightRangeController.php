<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\WeightRange\MinWeightRangeListingService;

class MinWeightRangeController extends Controller
{
    public static function index()
    {
        return [MinWeightRangeListingService::class, [
            'max' => static::input('max'),
        ], [
            'max' => '[max]',
        ]];
    }
}
