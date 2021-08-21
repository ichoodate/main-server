<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Drink\DrinkFindingService;
use App\Services\Keyword\Drink\DrinkListingService;

class DrinkController extends Controller
{
    public static function index()
    {
        return [DrinkListingService::class];
    }

    public static function show()
    {
        return [DrinkFindingService::class];
    }
}
