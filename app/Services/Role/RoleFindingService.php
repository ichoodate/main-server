<?php

namespace App\Services\Role;

use App\Database\Models\Role;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\Service;

class RoleFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'role for {{id}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {
                return ['user'];
            },

            'model_class' => function () {
                return Role::class;
            },

            'permitted_user' => function ($authUser, $model) {
                if ($model->{Role::USER_ID} == $authUser->getkey()) {
                    return $authUser;
                }
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
            FindingService::class,
            PermittedUserRequiringService::class,
        ];
    }
}
