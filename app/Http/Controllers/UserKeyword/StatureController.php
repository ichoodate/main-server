<?php

namespace App\Http\Controllers\UserKeyword;

use App\Http\Controller;
use App\Services\UserKeyword\UserStatureKeywordCreatingService;

class StatureController extends Controller
{
    public static function store()
    {
        return [UserStatureKeywordCreatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
