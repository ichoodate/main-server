<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Stature\StatureFindingService;
use App\Services\Keyword\Stature\StatureListingService;

class StatureController extends Controller
{
    public static function index()
    {
        return [StatureListingService::class];
    }

    public static function show()
    {
        return [StatureFindingService::class];
    }
}
