<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\AgeRange\MinAgeRangeListingService;

class MinAgeRangeController extends Controller
{
    public static function index()
    {
        return [MinAgeRangeListingService::class, [
            'max' => static::input('max'),
        ], [
            'max' => '[max]',
        ]];
    }
}
