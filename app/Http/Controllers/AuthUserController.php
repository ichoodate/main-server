<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Auth\AuthUserUpdatingService;

class AuthUserController extends Controller
{
    public static function index()
    {
        return static::bearerToken() ? null : [AuthUserFindingService::class];
    }

    public static function update()
    {
        return [AuthUserUpdatingService::class, [
            'auth_user' => auth()->user(),
            'birth' => static::input('birth'),
            'email' => static::input('email'),
            'name' => static::input('name'),
        ], [
            'auth_user' => 'authorized user',
            'birth' => '[birth]',
            'email' => '[email]',
            'name' => '[name]',
        ]];
    }
}
