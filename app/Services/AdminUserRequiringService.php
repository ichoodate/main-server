<?php

namespace App\Services;

use App\Database\Models\Role;
use App\Service;
use App\Service\AuthUserRequiringService;

class AdminUserRequiringService extends Service {

    public static function getArrBindNames()
    {
        return [
            'admin_role'
                => 'admin role for {{auth_user}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'admin_role' => ['auth_user', function ($authUser) {

                return $authUser->roleQuery()->qWhere(Role::TYPE, Role::TYPE_ADMIN)->first();
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
            'admin_role'
                => ['required']
        ];
    }

    public static function getArrTraits()
    {
        return [
            AuthUserRequiringService::class
        ];
    }

}
