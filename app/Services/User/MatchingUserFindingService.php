<?php

namespace App\Services\User;

use App\Models\User;
use FunctionalCoding\Service;

class MatchingUserFindingService extends Service
{
    public static function getBindNames()
    {
        return [
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
            'auth_user_gender' => function ($authUser) {
                return $authUser->{User::GENDER};
            },

            'available_expands' => function () {
                return [];
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
            'auth_user' => ['required'],

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
