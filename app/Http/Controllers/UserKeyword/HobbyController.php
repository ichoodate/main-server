<?php

namespace App\Http\Controllers\UserKeyword;

use App\Http\Controller;
use App\Services\UserKeyword\UserHobbyKeywordCreatingService;

class HobbyController extends Controller
{
    public static function store()
    {
        return [UserHobbyKeywordCreatingService::class, [
            'keyword_ids' => static::input('keyword_ids'),
        ], [
            'keyword_ids' => '[keyword_ids]',
        ]];
    }
}
