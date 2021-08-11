<?php

namespace App\Services\Subscription;

use App\Models\Subscription;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\Illuminate\Service\FindService;
use FunctionalCoding\Service;

class SubscriptionFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'subscription for {{id}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
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
