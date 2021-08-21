<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\PwdReset\PwdResetCreatingService;
use App\Services\PwdReset\PwdResetUpdatingService;

class PwdResetController extends Controller
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
            'token' => static::input('token'),
            'new_password' => static::input('new_password'),
        ], [
            'token' => '[token]',
            'new_password' => '[new_password]',
        ]];
    }
}
