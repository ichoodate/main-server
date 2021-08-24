<?php

namespace App\Http\Controllers\UserKeyword;

use App\Http\Controller;
use App\Services\UserKeyword\UserWeightKeywordUpdatingService;

class WeightController extends Controller
{
    public static function update()
    {
        return [UserWeightKeywordUpdatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
