<?php

namespace App\Services\PwdReset;

use App\Database\Models\PwdReset;
use App\Database\Models\User;
use Illuminate\Extend\Service;
use Illuminate\Support\Facades\Hash;

class PwdResetUpdatingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'result'
                => 'password reset for {{id}}',

            'result_complete'
                => 'completion of {{result}}',

            'result_token'
                => 'token of {{result}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'user.new_password' => ['user', 'new_password', function ($user, $newPassword) {

                $user->{User::PASSWORD} = Hash::make($newPassword);
                $user->save();
            }],

            'result_complete' => ['result', function ($result) {

                $result->{PwdReset::COMPLETE} = true;
                $result->save();
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'result' => ['id', function ($id) {

                return PwdReset::find($id);
            }],

            'result_token' => ['result', function ($result) {

                return $result->{PwdReset::TOKEN};
            }],

            'result_complete' => ['result', function ($result) {

                return $result->{PwdReset::COMPLETE};
            }],

            'user' => ['result', function ($result) {

                return (new User)->query()
                    ->qWhere(User::EMAIL, $result->{PwdReset::EMAIL})
                    ->first();
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
            'id'
                => ['required', 'integer'],

            'new_password'
                => ['required', 'string'],

            'result'
                => ['not_null'],

            'result_token'
                => ['same:{{token}}'],

            'result_complete'
                => ['false'],

            'token'
                => ['required', 'string']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
