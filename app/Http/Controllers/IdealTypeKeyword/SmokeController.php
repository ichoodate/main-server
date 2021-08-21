<?php

namespace App\Http\Controllers\IdealTypeKeyword;

use App\Http\Controller;
use App\Services\IdealTypeKeyword\IdealTypeSmokeKeywordCreatingService;

class SmokeController extends Controller
{
    public static function store()
    {
        return [IdealTypeSmokeKeywordCreatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
