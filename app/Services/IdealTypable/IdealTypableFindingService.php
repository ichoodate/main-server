<?php

namespace App\Services\IdealTypable;

use App\Database\Models\IdealTypable;
use App\Service;

class IdealTypableFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'ideal_typable of {{id}}'
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

                return IdealTypable::class;
            }],

            'permitted_user' => ['auth_user', 'model', function ($authUser, $model) {

                if ( $model->{IdealTypable::USER_ID} == $authUser->getkey() )
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
