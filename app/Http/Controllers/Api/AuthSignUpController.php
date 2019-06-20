<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\Auth\AuthSignUpService;

class AuthSignUpController extends ApiController {

    public static function store()
    {
        return [AuthSignUpService::class, [
            'email'
                => static::input('email'),
            'password'
                => static::input('password'),
            'gender'
                => static::input('gender'),
            'birth'
                => static::input('birth'),
            'name'
                => static::input('name')
        ], [
            'email'
                => '[email]',
            'password'
                => '[password]',
            'gender'
                => '[gender]',
            'birth'
                => '[birth]',
            'name'
                => '[name]'
        ]];
    }

}
