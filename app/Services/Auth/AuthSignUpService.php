<?php

namespace App\Services\Auth;

use App\Database\Models\Balance;
use App\Database\Models\Photo;
use App\Database\Models\Role;
use App\Database\Models\User;
use Illuminate\Extend\Service;
use App\Services\CreatingService;
use App\Services\FacePhoto\FacePhotoCreatingService;
use App\Services\UserIdealTypeKwdPvt\UserIdealTypeKwdPvtMergingService;
use App\Services\ProfilePhoto\ProfilePhotoCreatingService;
use App\Services\UserSelfKwdPvt\UserSelfKwdPvtMergingService;

class AuthSignUpService extends Service {

    public static function getArrBindNames()
    {
        return [
            'result'
                => 'created user',

            'same_email_user'
                => 'same email user for {{email}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'created' => ['created', function ($created) {

                auth()->setUser($created);
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'balance' => ['result', function ($result) {

                return (new Balance)->create([
                    Balance::USER_ID => $result->getKey(),
                    Balance::TYPE => Balance::TYPE_BASIC,
                    Balance::COUNT => 0,
                    Balance::DELETED_AT => '9999-12-31 23:59:59'
                ]);
            }],

            'created' => ['birth', 'email', 'password', 'gender', 'name', function ($birth, $email, $password, $gender, $name) {

                return (new User)->create([
                    User::BIRTH
                        => $birth,
                    User::EMAIL_VERIFIED
                        => false,
                    User::EMAIL
                        => $email,
                    User::GENDER
                        => $gender,
                    User::NAME
                        => $name,
                    User::PASSWORD
                        => $password
                ]);
            }],

            'same_email_user' => ['email', function ($email) {

                return (new User)->query()
                    ->lockForUpdate()
                    ->qWhere(User::EMAIL, $email)
                    ->first();
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [
            'created'
                => ['same_email_user']
        ];
    }

    public static function getArrRuleLists()
    {
        return [
            'birth'
                => ['required', 'date_format:Y-m-d'],

            'email'
                => ['required', 'string', 'email'],

            'gender'
                => ['required', 'string', 'in:' . implode(',', User::GENDER_VALUES)],

            'name'
                => ['required', 'string'],

            'password'
                => ['required', 'string', 'min:6'],

            'same_email_user'
                => ['null']
        ];
    }

    public static function getArrTraits()
    {
        return [
            CreatingService::class
        ];
    }

}
