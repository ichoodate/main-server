<?php

namespace App\Services\Notification;

use App\Database\Models\Activity;
use App\Database\Models\Notification;
use App\Services\AuthUserRequiringService;
use App\Services\PagingService;
use App\Service;

class NotificationPagingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => ['query', 'auth_user', function ($query, $authUser) {

                $query->qWhere(Notification::USER_ID, $authUser->getKey());
            }]
        ];
    }

     public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return Notification::class;
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
            AuthUserRequiringService::class,
            PagingService::class
        ];
    }

}
