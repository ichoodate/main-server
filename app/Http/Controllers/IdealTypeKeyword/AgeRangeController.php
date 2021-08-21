<?php

namespace App\Http\Controllers\IdealTypeKeyword;

use App\Http\Controller;
use App\Services\IdealTypeKeyword\IdealTypeAgeRangeKeywordCreatingService;

class AgeRangeController extends Controller
{
    public static function store()
    {
        return [IdealTypeAgeRangeKeywordCreatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
