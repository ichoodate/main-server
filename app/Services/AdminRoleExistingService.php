<?php

namespace App\Services;

use App\Models\Role;
use FunctionalCoding\Service;

class AdminRoleExistingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'admin_role' => 'admin role for {{auth_user}}',
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
                return $authUser->role()->qWhere(Role::TYPE, Role::TYPE_ADMIN)->first();
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
            'auth_user' => ['required'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
