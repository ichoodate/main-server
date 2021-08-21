<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Career\CareerFindingService;
use App\Services\Keyword\Career\CareerListingService;

class CareerController extends Controller
{
    public static function index()
    {
        return [CareerListingService::class];
    }

    public static function show()
    {
        return [CareerFindingService::class];
    }
}
