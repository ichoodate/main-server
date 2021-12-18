<?php

namespace App\Services\Notification;

use App\Models\Notification;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class NotificationFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'notification for {{id}}',
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
