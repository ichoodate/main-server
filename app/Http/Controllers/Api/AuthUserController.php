<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\Auth\AuthUserReturningService;

class AuthUserController extends ApiController {

    public static function index()
    {
        return [AuthUserReturningService::class, [
            'expands' => static::input('expands')
        ], [
            'expands' => '[expands]'
        ]];
    }

}
