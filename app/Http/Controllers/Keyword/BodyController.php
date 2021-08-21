<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Body\BodyFindingService;
use App\Services\Keyword\Body\BodyListingService;

class BodyController extends Controller
{
    public static function index()
    {
        return [BodyListingService::class];
    }

    public static function show()
    {
        return [BodyFindingService::class];
    }
}
