<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\StatureRange\MinStatureRangeListingService;

class MinStatureRangeController extends Controller
{
    public static function index()
    {
        return [MinStatureRangeListingService::class, [
            'max' => static::input('max'),
        ], [
            'max' => '[max]',
        ]];
    }
}
