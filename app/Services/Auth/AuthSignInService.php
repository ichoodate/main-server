<?php

namespace App\Services\Auth;

use App\Database\Models\User;
use App\Service;

class AuthSignInService extends Service {

    public static function getArrBindNames()
    {
        return [
            'result' => 'user for {{email}} and {{password}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'is_signed_in' => ['email', 'password', function ($email, $password) {

                return auth()->attempt([
                    User::EMAIL => $email,
                    User::PASSWORD => $password
                ]);
            }],

            'result' => ['is_signed_in', 'email', function ($isSignedIn, $email) {

                if ( $isSignedIn )
                {
                    return User::query()
                        ->qWhere(User::EMAIL, $email)
                        ->first();
                }
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'email'
                => ['required', 'email'],

            'password'
                => ['required', 'string'],

            'result'
                => ['not_null']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
