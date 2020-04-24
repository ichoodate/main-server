<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\User\UserFindingService;
use App\Services\Auth\AuthUserUpdatingService;

class AuthUserController extends ApiController {

    public static function index()
    {
        return !auth()->user() ? null : [UserFindingService::class, [
            'expands'
                => static::input('expands'),
            'id'
                => auth()->user()->getKey()

        ], [
            'expands'
                => '[expands]',
            'id'
                => 'authorized user\'s ID'
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
