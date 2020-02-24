<?php

namespace App\Http\Controllers\Api\SelfKeyword;

use App\Http\Controllers\ApiController;
use App\Services\UserSelfKwdPvt\StatureUserSelfKwdPvtCreatingService;

class StatureController extends ApiController {

    public static function store()
    {
        return [StatureUserSelfKwdPvtCreatingService::class, [
            'auth_user'
                => auth()->user(),
            'keyword_id'
                => static::input('keyword_id')
        ], [
            'auth_user'
                => 'authorized user',
            'keyword_id'
                => '[keyword_id]'
        ]];
    }

}
