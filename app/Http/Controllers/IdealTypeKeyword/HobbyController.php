<?php

namespace App\Http\Controllers\IdealTypeKeyword;

use App\Http\Controller;
use App\Services\IdealTypeKeyword\IdealTypeHobbyKeywordCreatingService;

class HobbyController extends Controller
{
    public static function store()
    {
        return [IdealTypeHobbyKeywordCreatingService::class, [
            'auth_user' => auth()->user(),
            'keyword_ids' => static::input('keyword_ids'),
        ], [
            'auth_user' => 'authorized user',
            'keyword_ids' => '[keyword_ids]',
        ]];
    }
}
