<?php

namespace App\Services\Profilable;

use App\Database\Models\Profilable;
use App\Service;

class ProfilableFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'profilable of {{id}}'
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

                return Profilable::class;
            }],

            'permitted_user' => ['auth_user', 'model', function ($authUser, $model) {

                if ( $model->{Profilable::USER_ID} == $authUser->getkey() )
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
            PermittedUserRequiringService::class,
            FindingService::class
        ];
    }

}
