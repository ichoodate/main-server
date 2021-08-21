<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\EduBg\EduBgFindingService;
use App\Services\Keyword\EduBg\EduBgListingService;

class EduBgController extends Controller
{
    public static function index()
    {
        return [EduBgListingService::class];
    }

    public static function show()
    {
        return [EduBgFindingService::class];
    }
}
