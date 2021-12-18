<?php

namespace App\Services\Auth;

use App\Models\Balance;
use App\Models\User;
use FunctionalCoding\Service;

class AuthSignUpService extends Service
{
    public static function getBindNames()
    {
        return [
            'same_email_user' => 'same email user for {{email}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'balance' => function ($result) {
                return (new Balance())->create([
                    Balance::USER_ID => $result->getKey(),
                    Balance::TYPE => 'basic',
                    Balance::COUNT => 0,
                    Balance::DELETED_AT => null,
                ]);
            },

            'result' => function ($birth, $email, $gender, $name, $password) {
                return (new User())->create([
                    User::BIRTH => $birth,
                    User::EMAIL_VERIFIED => false,
                    User::EMAIL => $email,
                    User::GENDER => $gender,
                    User::NAME => $name,
                    User::PASSWORD => $password,
                ]);
            },

            'same_email_user' => function ($email) {
                return (new User())->query()
                    ->lockForUpdate()
                    ->where(User::EMAIL, $email)
                    ->first()
                ;
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [
            'result' => ['same_email_user'],
        ];
    }

    public static function getRuleLists()
    {
        return [
            'birth' => ['required', 'date_format:Y-m-d'],

            'email' => ['required', 'string', 'email'],

            'gender' => ['required', 'string', 'in:'.implode(',', User::GENDER_VALUES)],

            'name' => ['required', 'string'],

            'password' => ['required', 'string', 'min:6'],

            'same_email_user' => ['null'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
