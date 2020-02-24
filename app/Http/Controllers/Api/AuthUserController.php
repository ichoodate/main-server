<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\Auth\AuthUserReturningService;
use App\Services\Auth\AuthUserUpdatingService;

class AuthUserController extends ApiController {

    public static function index()
    {
        return [AuthUserReturningService::class, [
            'expands' => static::input('expands')
        ], [
            'expands' => '[expands]'
        ]];
    }

    public static function update()
    {
        return [AuthUserUpdatingService::class, [
            'auth_user'
                => auth()->user(),
            'birth'
                => static::input('birth'),
            'email'
                => static::input('email'),
            'name'
                => static::input('name')
        ], [
            'auth_user'
                => 'authorized user',
            'birth'
                => '[birth]',
            'email'
                => '[email]',
            'name'
                => '[name]'
        ]];
    }

}
