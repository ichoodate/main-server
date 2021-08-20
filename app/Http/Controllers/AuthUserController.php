<?php

namespace App\Http\Controllers;

use App\Http\ControllersController;
use App\Services\Auth\AuthUserUpdatingService;
use App\Services\User\UserFindingService;

class AuthUserController extends ApiController
{
    public static function index()
    {
        return !auth()->user() ? null : [UserFindingService::class, [
            'expands' => static::input('expands'),
            'id' => auth()->user()->getKey(),
        ], [
            'expands' => '[expands]',
            'id' => 'authorized user\'s ID',
        ]];
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
