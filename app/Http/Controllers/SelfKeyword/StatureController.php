<?php

namespace App\Http\Controllers\SelfKeyword;

use App\Http\ControllersController;
use App\Services\UserSelfKwdPvt\UserStatureKeywordCreatingService;

class StatureController extends ApiController
{
    public static function store()
    {
        return [UserStatureKeywordCreatingService::class, [
            'auth_user' => auth()->user(),
            'keyword_id' => static::input('keyword_id'),
        ], [
            'auth_user' => 'authorized user',
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
