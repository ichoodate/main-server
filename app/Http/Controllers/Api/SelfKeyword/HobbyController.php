<?php

namespace App\Http\Controllers\Api\SelfKeyword;

use App\Http\Controllers\ApiController;
use App\Services\UserSelfKwdPvt\HobbyUserSelfKwdPvtUpdatingService;

class HobbyController extends ApiController {

    public static function store()
    {
        return [HobbyUserSelfKwdPvtUpdatingService::class, [
            'auth_user'
                => auth()->user(),
            'keyword_ids'
                => static::input('keyword_ids')
        ], [
            'auth_user'
                => 'authorized user',
            'keyword_ids'
                => '[keyword_ids]'
        ]];
    }

}
