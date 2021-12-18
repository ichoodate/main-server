<?php

namespace App\Services\Role;

use App\Models\Role;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class RoleFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'role for {{id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
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

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [];
    }

    public static function getTraits()
    {
        return [
            FindService::class,
            PermittedUserRequiringService::class,
        ];
    }
}
