<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Hobby\HobbyFindingService;
use App\Services\Keyword\Hobby\HobbyListingService;

class HobbyController extends Controller
{
    public static function index()
    {
        return [HobbyListingService::class];
    }

    public static function show()
    {
        return [HobbyFindingService::class];
    }
}
