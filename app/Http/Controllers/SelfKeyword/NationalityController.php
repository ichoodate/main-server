<?php

namespace App\Http\Controllers\SelfKeyword;

use App\Http\ControllersController;
use App\Services\UserSelfKwdPvt\UserNationalityKeywordCreatingService;

class NationalityController extends ApiController
{
    public static function store()
    {
        return [UserNationalityKeywordCreatingService::class, [
            'auth_user' => auth()->user(),
            'keyword_id' => static::input('keyword_id'),
        ], [
            'auth_user' => 'authorized user',
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
