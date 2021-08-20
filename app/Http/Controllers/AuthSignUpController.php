<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Auth\AuthSignUpService;

class AuthSignUpController extends Controller
{
    public static function store()
    {
        return [AuthSignUpService::class, [
            'email' => static::input('email'),
            'password' => static::input('password'),
            'gender' => static::input('gender'),
            'birth' => static::input('birth'),
            'name' => static::input('name'),
        ], [
            'email' => '[email]',
            'password' => '[password]',
            'gender' => '[gender]',
            'birth' => '[birth]',
            'name' => '[name]',
        ]];
    }
}
