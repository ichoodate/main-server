<?php

namespace App\Services\Subscription;

use App\Models\Subscription;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class SubscriptionFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'subscription for {{id}}',
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
                return ['payment', 'user'];
            },

            'model_class' => function () {
                return Subscription::class;
            },

            'permitted_user' => function ($authUser, $model) {
                if (in_array($authUser->getKey(), [$model->{Subscription::USER_ID}])) {
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
