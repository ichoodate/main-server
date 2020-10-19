<?php

namespace App\Services\PwdReset;

use App\Database\Models\PwdReset;
use App\Database\Models\User;
use App\Service;
use App\Services\CreatingService;

class PwdResetCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'user'
                => 'user for {{email}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'user' => ['email', function ($email) {

                return (new User)->query()
                    ->qWhere(User::EMAIL, $email)
                    ->first();
            }],

            'created' => ['user', function ($user) {

                return (new PwdReset)->create([
                    PwdReset::TOKEN    => str_random(32),
                    PwdReset::EMAIL    => $user->{User::EMAIL},
                    PwdReset::COMPLETE => false
                ]);
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

            'user'
                => ['not_null']
        ];
    }

    public static function getArrTraits()
    {
        return [
            CreatingService::class
        ];
    }

}
