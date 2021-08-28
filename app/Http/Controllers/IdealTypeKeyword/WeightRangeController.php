<?php

namespace App\Http\Controllers\IdealTypeKeyword;

use App\Http\Controller;
use App\Services\IdealTypeKeyword\IdealTypeWeightRangeKeywordUpdatingService;

class WeightRangeController extends Controller
{
    public static function store()
    {
        return [IdealTypeWeightRangeKeywordUpdatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
