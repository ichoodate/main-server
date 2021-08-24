<?php

namespace App\Http\Controllers\UserKeyword;

use App\Http\Controller;
use App\Services\UserKeyword\UserDrinkKeywordUpdatingService;

class DrinkController extends Controller
{
    public static function update()
    {
        return [UserDrinkKeywordUpdatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
