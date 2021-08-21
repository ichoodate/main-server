<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Weight\WeightFindingService;
use App\Services\Keyword\Weight\WeightListingService;

class WeightController extends Controller
{
    public static function index()
    {
        return [WeightListingService::class];
    }

    public static function show()
    {
        return [WeightFindingService::class];
    }
}
