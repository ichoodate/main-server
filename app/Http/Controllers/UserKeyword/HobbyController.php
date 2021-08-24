<?php

namespace App\Http\Controllers\UserKeyword;

use App\Http\Controller;
use App\Services\UserKeyword\UserHobbyKeywordUpdatingService;

class HobbyController extends Controller
{
    public static function update()
    {
        return [UserHobbyKeywordUpdatingService::class, [
            'keyword_ids' => static::input('keyword_ids'),
        ], [
            'keyword_ids' => '[keyword_ids]',
        ]];
    }
}
