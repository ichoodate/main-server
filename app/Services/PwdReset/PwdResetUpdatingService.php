<?php

namespace App\Services\PwdReset;

use App\Models\PwdReset;
use App\Models\User;
use FunctionalCoding\Service;
use Illuminate\Support\Facades\Hash;

class PwdResetUpdatingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'result' => 'password reset for {{id}}',

            'result_complete' => 'completion of {{result}}',

            'result_token' => 'token of {{result}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'result_complete' => function ($result) {
                $result->{PwdReset::COMPLETE} = true;
                $result->save();
            },

            'user.new_password' => function ($newPassword, $user) {
                $user->{User::PASSWORD} = Hash::make($newPassword);
                $user->save();
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'result' => function ($id) {
                return PwdReset::find($id);
            },

            'result_complete' => function ($result) {
                return $result->{PwdReset::COMPLETE};
            },

            'result_token' => function ($result) {
                return $result->{PwdReset::TOKEN};
            },

            'user' => function ($result) {
                return (new User())->query()
                    ->qWhere(User::EMAIL, $result->{PwdReset::EMAIL})
                    ->first()
                ;
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
            'id' => ['required', 'integer'],

            'new_password' => ['required', 'string'],

            'result' => ['not_null'],

            'result_token' => ['same:{{token}}'],

            'result_complete' => ['false'],

            'token' => ['required', 'string'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
