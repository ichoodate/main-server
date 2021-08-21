<?php

namespace App\Services\Role;

use App\Models\Role;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class RoleListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => function ($authUser, $query) {
                $query->qWhere(Role::USER_ID, $authUser->getKey());
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'token' => $authToken,
                ], [
                    'token' => '{{auth_token}}',
                ]];
            },

            'available_expands' => function () {
                return ['user'];
            },

            'model_class' => function () {
                return Role::class;
            },
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [];
    }

    public static function getArrTraits()
    {
        return [
            ListService::class,
        ];
    }
}
