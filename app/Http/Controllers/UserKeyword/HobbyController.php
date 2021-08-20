<?php

namespace App\Http\Controllers\UserKeyword;

use App\Http\Controller;
use App\Services\UserKeyword\UserHobbyKeywordCreatingService;

class HobbyController extends Controller
{
    public static function store()
    {
        return [UserHobbyKeywordCreatingService::class, [
            'auth_user' => auth()->user(),
            'keyword_ids' => static::input('keyword_ids'),
        ], [
            'auth_user' => 'authorized user',
            'keyword_ids' => '[keyword_ids]',
        ]];
    }
}
