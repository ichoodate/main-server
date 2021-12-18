<?php

namespace App\Services\PwdReset;

use App\Models\PwdReset;
use App\Models\User;
use FunctionalCoding\Service;

class PwdResetUpdatingService extends Service
{
    public static function getBindNames()
    {
        return [
            'completed_password_reset' => 'already completed {{password_reset}}',

            'password_reset' => 'password_reset for {{id}}',

            'password_reset_token' => 'token of {{password_reset}}',

            'user' => 'user for {{password_reset}}',
        ];
    }

    public static function getCallbacks()
    {
        return [
            'completed_password_reset.password_reset' => function ($passwordReset) {
                $passwordReset->{PwdReset::COMPLETE} = true;
                $passwordReset->save();
            },

            'user.new_password' => function ($newPassword, $user) {
                $user->{User::PASSWORD} = $newPassword;
                $user->save();
            },
        ];
    }

    public static function getLoaders()
    {
        return [
            'completed_password_reset' => function ($passwordReset) {
                if (true === $passwordReset->{PwdReset::COMPLETE}) {
                    return $passwordReset;
                }

                return null;
            },

            'password_reset' => function ($id) {
                return PwdReset::find($id);
            },

            'password_reset_token' => function ($passwordReset) {
                return $passwordReset->{PwdReset::TOKEN};
            },

            'result' => function ($passwordReset) {
                return $passwordReset;
            },

            'user' => function ($passwordReset) {
                return (new User())->query()
                    ->where(User::EMAIL, $passwordReset->{PwdReset::EMAIL})
                    ->first()
                ;
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [
            'result' => ['completed_password_reset'],
        ];
    }

    public static function getRuleLists()
    {
        return [
            'id' => ['required', 'integer'],

            'completed_password_reset' => ['null'],

            'new_password' => ['required', 'string'],

            'password_reset' => ['not_null'],

            'password_reset_token' => ['same:{{token}}'],

            'token' => ['required', 'string'],

            'user' => ['not_null'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
