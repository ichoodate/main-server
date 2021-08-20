<?php

namespace App\Http\Controllers\SelfKeyword;

use App\Http\ControllersController;
use App\Services\UserSelfKwdPvt\HobbyUserSelfKwdPvtCreatingService;

class HobbyController extends ApiController
{
    public static function store()
    {
        return [HobbyUserSelfKwdPvtCreatingService::class, [
            'auth_user' => auth()->user(),
            'keyword_ids' => static::input('keyword_ids'),
        ], [
            'auth_user' => 'authorized user',
            'keyword_ids' => '[keyword_ids]',
        ]];
    }
}
