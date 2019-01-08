<?php

namespace App\Services\User;

use App\Database\Models\User;
use App\Service;

class UserFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'user of {{id}}'
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

                return User::class;
            }],

            'permitted_user' => ['auth_user', 'model', function ($authUser, $model) {

                if ( $authUser->getKey() == $model->getKey() )
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
        return [];
    }

}
