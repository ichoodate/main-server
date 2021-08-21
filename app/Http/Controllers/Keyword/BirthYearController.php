<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\BirthYear\BirthYearFindingService;
use App\Services\Keyword\BirthYear\BirthYearListingService;

class BirthYearController extends Controller
{
    public static function index()
    {
        return [BirthYearListingService::class];
    }

    public static function show()
    {
        return [BirthYearFindingService::class];
    }
}
