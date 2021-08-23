<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Nationality\NationalityFindingService;
use App\Services\Keyword\Nationality\NationalityListingService;

class NationalityController extends Controller
{
    public static function index()
    {
        return [NationalityListingService::class];
    }

    public static function show()
    {
        return [NationalityFindingService::class];
    }
}
