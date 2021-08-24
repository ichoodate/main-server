<?php

namespace App\Http\Controllers\IdealTypeKeyword;

use App\Http\Controller;
use App\Services\IdealTypeKeyword\IdealTypeCareerKeywordUpdatingService;

class CareerController extends Controller
{
    public static function update()
    {
        return [IdealTypeCareerKeywordUpdatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
