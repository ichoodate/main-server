<?php

namespace App\Services\PwdReset;

use App\Models\PwdReset;
use App\Models\User;
use FunctionalCoding\Service;
use Illuminate\Support\Str;

class PwdResetCreatingService extends Service
{
    public static function getBindNames()
    {
        return [
            'user' => 'user for {{email}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'result' => function ($user) {
                return (new PwdReset())->create([
                    PwdReset::TOKEN => Str::random(32),
                    PwdReset::EMAIL => $user->{User::EMAIL},
                    PwdReset::COMPLETE => false,
                ]);
            },

            'user' => function ($email) {
                return (new User())->query()
                    ->where(User::EMAIL, $email)
                    ->first()
                ;
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'email' => ['required', 'email'],

            'user' => ['not_null'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
