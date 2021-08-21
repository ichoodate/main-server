<?php

namespace App\Http\Controllers\IdealTypeKeyword;

use App\Http\Controller;
use App\Services\IdealTypeKeyword\IdealTypeStatureRangeKeywordCreatingService;

class StatureRangeController extends Controller
{
    public static function store()
    {
        return [IdealTypeStatureRangeKeywordCreatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
