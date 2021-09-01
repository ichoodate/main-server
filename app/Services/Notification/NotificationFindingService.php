<?php

namespace App\Services\Notification;

use App\Models\Notification;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class NotificationFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'notification for {{id}}',
        ];
    }

    public static function getArrCallbacks()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {
                return ['relatedObj.concrete', 'user'];
            },

            'model_class' => function () {
                return Notification::class;
            },

            'permitted_user' => function ($authUser, $model) {
                if ($model->{Notification::USER_ID} == $authUser->getkey()) {
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
            FindService::class,
            PermittedUserRequiringService::class,
        ];
    }
}
