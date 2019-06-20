<?php

namespace App\Services\Activity;

use App\Database\Models\Activity;
use App\Service;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;

class ActivityFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'activity for {{id}}'
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

                return Activity::class;
            }],

            'permitted_user' => ['auth_user', 'model', function ($authUser, $model) {

                if ( $authUser->getkey() == $model->{Activity::USER_ID} )
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
