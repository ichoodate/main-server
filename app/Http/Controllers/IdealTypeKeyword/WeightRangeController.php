<?php

namespace App\Http\Controllers\IdealTypeKeyword;

use App\Http\Controller;
use App\Services\IdealTypeKeyword\IdealTypeWeightRangeKeywordCreatingService;

class WeightRangeController extends Controller
{
    public static function store()
    {
        return [IdealTypeWeightRangeKeywordCreatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
