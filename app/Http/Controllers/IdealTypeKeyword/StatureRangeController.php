<?php

namespace App\Http\Controllers\IdealTypeKeyword;

use App\Http\Controller;
use App\Services\IdealTypeKeyword\IdealTypeStatureRangeKeywordUpdatingService;

class StatureRangeController extends Controller
{
    public static function update()
    {
        return [IdealTypeStatureRangeKeywordUpdatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
