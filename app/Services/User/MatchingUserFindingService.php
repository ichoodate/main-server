<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\Service;

class MatchingUserFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'auth_user' => 'authorized user',

            'auth_user_gender' => 'gender of {{auth_user}}',

            'model_gender' => 'gender of {{model}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'auth_token' => $authToken,
                ], [
                    'auth_token' => '{{auth_token}}',
                ]];
            },

            'available_expands' => function () {
                return [];
            },

            'auth_user_gender' => function ($authUser) {
                return $authUser->{User::GENDER};
            },

            'model_gender' => function ($model) {
                return $model->{User::GENDER};
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
            'auth_user_gender' => ['different:{{model_gender}}'],
        ];
    }

    public static function getTraits()
    {
        return [
            UserFindingService::class,
        ];
    }
}
