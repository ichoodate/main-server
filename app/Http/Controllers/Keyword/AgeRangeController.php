<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\AgeRange\AgeRangeFindingService;

class AgeRangeController extends Controller
{
    public static function show()
    {
        return [AgeRangeFindingService::class];
    }
}
