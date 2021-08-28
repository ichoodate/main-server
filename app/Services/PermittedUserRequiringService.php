<?php

namespace App\Services;

use App\Models\Role;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\Service;

class PermittedUserRequiringService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'admin_role' => 'admin role for {{auth_user}}',

            'auth_user' => 'authorized user',

            'permitted_user' => '{{auth_user}} who is related user of {{model}}',
        ];
    }

    public static function getArrCallbacks()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'admin_role' => function ($authUser) {
                return $authUser->roles()->where(Role::TYPE, 'admin')->first();
            },

            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'auth_token' => $authToken,
                ], [
                    'auth_token' => '{{auth_token}}',
                ]];
            },

            'permitted_user' => function () {
                throw new \Exception();
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
            'permitted_user' => ['required'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
