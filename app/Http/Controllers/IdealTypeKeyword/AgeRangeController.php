<?php

namespace App\Http\Controllers\IdealTypeKeyword;

use App\Http\Controller;
use App\Services\IdealTypeKeyword\IdealTypeAgeRangeKeywordUpdatingService;

class AgeRangeController extends Controller
{
    public static function update()
    {
        return [IdealTypeAgeRangeKeywordUpdatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
