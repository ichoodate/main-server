<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Auth\AuthUserUpdatingService;

class AuthUserController extends Controller
{
    public static function index()
    {
        return static::bearerToken() ? [AuthUserFindingService::class] : null;
    }

    public static function update()
    {
        return [AuthUserUpdatingService::class, [
            'birth' => static::input('birth'),
            'email' => static::input('email'),
            'name' => static::input('name'),
        ], [
            'birth' => '[birth]',
            'email' => '[email]',
            'name' => '[name]',
        ]];
    }
}
