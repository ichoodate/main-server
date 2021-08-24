<?php

namespace App\Services;

use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\Service;

class PermittedUserRequiringService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'admin_role' => 'admin role for {{auth_user}}',

            'permitted_user' => '{{auth_user}} who is related user of {{model}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'admin_role' => function ($authUser) {
                return $authUser->role()->where(Role::TYPE, Role::TYPE_ADMIN)->first();
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
