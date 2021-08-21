<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Language\LanguageFindingService;
use App\Services\Keyword\Language\LanguageListingService;

class LanguageController extends Controller
{
    public static function index()
    {
        return [LanguageListingService::class];
    }

    public static function show()
    {
        return [LanguageFindingService::class];
    }
}
