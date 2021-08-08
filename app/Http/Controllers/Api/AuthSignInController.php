<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\Auth\AuthSignInService;

class AuthSignInController extends ApiController
{
    public static function store()
    {
        return [AuthSignInService::class, [
            'email' => static::input('email'),
            'password' => static::input('password'),
        ], [
            'email' => '[email]',
            'password' => '[password]',
        ]];
    }
}
