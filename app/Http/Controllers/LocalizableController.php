<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Localizable\LocalizableFindingService;
use App\Services\Localizable\LocalizableListingService;

class LocalizableController extends Controller
{
    public static function index()
    {
        return [LocalizableListingService::class];
    }

    public static function show()
    {
        return [LocalizableFindingService::class];
    }
}
