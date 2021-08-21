<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Blood\BloodFindingService;
use App\Services\Keyword\Blood\BloodListingService;

class BloodController extends Controller
{
    public static function index()
    {
        return [BloodListingService::class];
    }

    public static function show()
    {
        return [BloodFindingService::class];
    }
}
