<?php

namespace App\Services\Notification;

use App\Database\Models\Notification;
use App\Service;

class NotificationFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'notification of {{id}}'
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

                return Notification::class;
            }],

            'permitted_user' => ['auth_user', 'model', function ($authUser, $model) {

                if ( $model->{Notification::USER_ID} == $authUser->getkey() )
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
