<?php

namespace App\Services\Notification;

use App\Database\Models\Activity;
use App\Database\Models\Notification;
use App\Services\Activity\ActivityFindingService;
use App\Service;

class ActivityNotificationListingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'activity'
                => 'activity for {{activity_id}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.activity' => ['query', 'activity', function ($query, $activity) {

                $query->qWhere(Notification::ACTIVITY_ID, $activity->getKey());
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'activity' => ['auth_user', 'activity_id', function ($authUser, $activityId) {

                return [ActivityFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $activityId
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => '{{activity_id}}'
                ]];
            }],

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
        return [
            'activity_id'
                => ['required', 'integer']
        ];
    }

    public static function getArrTraits()
    {
        return [
            AuthUserRequiringService::class
        ];
    }

}
