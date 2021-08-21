<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\StatureRange\MaxStatureRangeListingService;

class MaxStatureRangeController extends Controller
{
    public static function index()
    {
        return [MaxStatureRangeListingService::class, [
            'min' => static::input('min'),
        ], [
            'min' => '[min]',
        ]];
    }
}
