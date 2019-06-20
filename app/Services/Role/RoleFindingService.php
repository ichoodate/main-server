<?php

namespace App\Services\Role;

use App\Database\Models\Role;
use App\Service;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;

class RoleFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'role for {{id}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return Role::class;
            }],

            'permitted_user' => ['auth_user', 'model', function ($authUser, $model) {

                if ( $model->{Role::USER_ID} == $authUser->getkey() )
                {
                    return $authUser;
                }
            }]
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
            PermittedUserRequiringService::class
        ];
    }

}
