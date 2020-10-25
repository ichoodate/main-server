<?php

namespace App\Services\Notification;

use App\Database\Models\Notification;
use Illuminate\Extend\Service;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;

class NotificationFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'notification for {{id}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => [function () {

                return ['related', 'user'];
            }],

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
            FindingService::class,
            PermittedUserRequiringService::class
        ];
    }

}
