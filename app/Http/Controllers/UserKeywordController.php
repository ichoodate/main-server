<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\UserKeyword\UserKeywordListingService;

class UserKeywordController extends Controller
{
    public static function index()
    {
        return [UserKeywordListingService::class];
    }
}
