<?php

namespace App\Http\Controllers\Api\IdealTypeKeyword;

use App\Http\Controllers\ApiController;
use App\Services\UserIdealTypeKwdPvt\AgeRangeUserIdealTypeKwdPvtUpdatingService;

class AgeRangeController extends ApiController {

    public static function store()
    {
        return [AgeRangeUserIdealTypeKwdPvtUpdatingService::class, [
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
