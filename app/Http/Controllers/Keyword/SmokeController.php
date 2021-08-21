<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Smoke\SmokeFindingService;
use App\Services\Keyword\Smoke\SmokeListingService;

class SmokeController extends Controller
{
    public static function index()
    {
        return [SmokeListingService::class];
    }

    public static function show()
    {
        return [SmokeFindingService::class];
    }
}
