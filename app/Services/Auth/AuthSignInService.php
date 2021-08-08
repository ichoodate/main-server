<?php

namespace App\Services\Auth;

use App\Database\Models\User;
use Illuminate\Extend\Service;

class AuthSignInService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'result' => 'user for {{email}} and {{password}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'is_signed_in' => function ($email, $password) {
                return auth()->attempt([
                    User::EMAIL => $email,
                    User::PASSWORD => $password,
                ]);
            },

            'result' => function ($email, $isSignedIn) {
                if ($isSignedIn) {
                    return User::query()
                        ->qWhere(User::EMAIL, $email)
                        ->first()
                    ;
                }
            },
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'email' => ['required', 'email'],

            'password' => ['required', 'string'],

            'result' => ['not_null'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
