<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\WeightRange\WeightRangeFindingService;

class WeightRangeController extends Controller
{
    public static function show()
    {
        return [WeightRangeFindingService::class];
    }
}
