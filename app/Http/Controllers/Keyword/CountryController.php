<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Country\CountryFindingService;
use App\Services\Keyword\Country\CountryListingService;

class CountryController extends Controller
{
    public static function index()
    {
        return [CountryListingService::class];
    }

    public static function show()
    {
        return [CountryFindingService::class];
    }
}
