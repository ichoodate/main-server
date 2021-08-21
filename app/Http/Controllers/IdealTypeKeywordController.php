<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\IdealTypeKeyword\IdealTypeKeywordListingService;

class IdealTypeKeywordController extends Controller
{
    public static function index()
    {
        return [IdealTypeKeywordListingService::class];
    }
}
