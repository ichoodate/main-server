<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\StatureRange\StatureRangeFindingService;

class StatureRangeController extends Controller
{
    public static function show()
    {
        return [StatureRangeFindingService::class];
    }
}
