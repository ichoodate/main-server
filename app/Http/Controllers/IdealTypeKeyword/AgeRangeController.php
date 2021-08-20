<?php

namespace App\Http\Controllers\IdealTypeKeyword;

use App\Http\ControllersController;
use App\Services\UserIdealTypeKwdPvt\AgeRangeUserIdealTypeKwdPvtCreatingService;

class AgeRangeController extends ApiController
{
    public static function store()
    {
        return [AgeRangeUserIdealTypeKwdPvtCreatingService::class, [
            'auth_user' => auth()->user(),
            'keyword_id' => static::input('keyword_id'),
        ], [
            'auth_user' => 'authorized user',
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
