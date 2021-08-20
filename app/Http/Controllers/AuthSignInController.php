<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Auth\AuthSignInService;

class AuthSignInController extends Controller
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
