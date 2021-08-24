<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\Service;

class MatchingUserFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'auth_user_gender' => 'gender of {{auth_user}}',

            'model_gender' => 'gender of {{model}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
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

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user_gender' => ['different:{{model_gender}}'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            UserFindingService::class,
        ];
    }
}
