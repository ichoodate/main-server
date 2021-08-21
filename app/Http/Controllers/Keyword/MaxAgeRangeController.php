<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\AgeRange\MaxAgeRangeListingService;

class MaxAgeRangeController extends Controller
{
    public static function index()
    {
        return [MaxAgeRangeListingService::class, [
            'min' => static::input('min'),
        ], [
            'min' => '[min]',
        ]];
    }
}
