<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Religion\ReligionFindingService;
use App\Services\Keyword\Religion\ReligionListingService;

class ReligionController extends Controller
{
    public static function index()
    {
        return [ReligionListingService::class];
    }

    public static function show()
    {
        return [ReligionFindingService::class];
    }
}
