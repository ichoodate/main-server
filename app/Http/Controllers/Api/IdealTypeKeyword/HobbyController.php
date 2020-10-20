<?php

namespace App\Http\Controllers\Api\IdealTypeKeyword;

use App\Http\Controllers\ApiController;
use App\Services\UserIdealTypeKwdPvt\HobbyUserIdealTypeKwdPvtCreatingService;

class HobbyController extends ApiController {

    public static function store()
    {
        return [HobbyUserIdealTypeKwdPvtCreatingService::class, [
            'auth_user'
                => auth()->user(),
            'keyword_ids'
                => static::input('keyword_ids')
        ], [
            'auth_user'
                => 'authorized user',
            'keyword_ids'
                => '[keyword_ids]',
        ]];
    }

}
