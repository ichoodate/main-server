<?php

namespace App\Http\Controllers\Api\IdealTypeKeyword;

use App\Http\Controllers\ApiController;
use App\Services\UserIdealTypeKwdPvt\SmokeUserIdealTypeKwdPvtCreatingService;

class SmokeController extends ApiController {

    public static function store()
    {
        return [SmokeUserIdealTypeKwdPvtCreatingService::class, [
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
