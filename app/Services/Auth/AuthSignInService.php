<?php

namespace App\Services\Auth;

use App\Models\User;
use FunctionalCoding\JWT\Service\TokenEncryptionService;
use FunctionalCoding\Service;
use Illuminate\Support\Facades\Hash;

class AuthSignInService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'user' => 'matching user for {{email}} and {{password}}',
        ];
    }

    public static function getArrCallbacks()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'payload' => function ($user) {
                return [
                    'expired_at' => '9999-12-31 12:59:59',
                    'uid' => $user->getKey(),
                    'verified' => true,
                ];
            },

            'result' => function ($payload) {
                return [TokenEncryptionService::class, [
                    'payload' => $payload,
                    'public_key' => file_get_contents(app()->storagePath('app/id_rsa.pub')),
                ], [
                    'payload' => 'payload of {{user}}',
                    'public_key' => '{public encryption key}',
                ]];
            },

            'user' => function ($email, $password) {
                $user = User::lockForUpdate()->where('email', $email)->first();

                if (!empty($user) && Hash::check($password, $user->password)) {
                    return $user;
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
            'email' => ['required', 'string', 'email'],

            'password' => ['required', 'string'],

            'user' => ['required'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
