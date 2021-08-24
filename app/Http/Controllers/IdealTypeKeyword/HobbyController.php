<?php

namespace App\Http\Controllers\IdealTypeKeyword;

use App\Http\Controller;
use App\Services\IdealTypeKeyword\IdealTypeHobbyKeywordUpdatingService;

class HobbyController extends Controller
{
    public static function update()
    {
        return [IdealTypeHobbyKeywordUpdatingService::class, [
            'keyword_ids' => static::input('keyword_ids'),
        ], [
            'keyword_ids' => '[keyword_ids]',
        ]];
    }
}
