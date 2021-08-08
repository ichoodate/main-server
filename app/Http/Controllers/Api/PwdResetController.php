<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\PwdReset\PwdResetCreatingService;
use App\Services\PwdReset\PwdResetUpdatingService;

class PwdResetController extends ApiController
{
    public static function store()
    {
        return [PwdResetCreatingService::class, [
            'email' => static::input('email'),
        ], [
            'email' => '[email]',
        ]];
    }

    public static function update()
    {
        return [PwdResetUpdatingService::class, [
            'id' => request()->route()->pwd_reset,
            'token' => static::input('token'),
            'new_password' => static::input('new_password'),
        ], [
            'id' => request()->route()->pwd_reset,
            'token' => '[token]',
            'new_password' => '[new_password]',
        ]];
    }
}
