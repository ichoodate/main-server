<?php

namespace App\Services\Friend;

use App\Models\Friend;
use App\Services\Auth\AuthUserFindingService;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\ORM\Eloquent\Service\Feature\ModelFeatureService;
use FunctionalCoding\Service;

class FriendDeletingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbacks()
    {
        return [
            'result.model' => function ($model) {
                $model->delete();
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'auth_token' => $authToken,
                ], [
                    'auth_token' => '{{auth_token}}',
                ]];
            },

            'model_class' => function () {
                return Friend::class;
            },

            'permitted_user' => function ($authUser, $model) {
                if (in_array($authUser->getKey(), [$model->{Friend::SENDER_ID}])) {
                    return $authUser;
                }
            },

            'result' => function () {
                return null;
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
            ModelFeatureService::class,
            PermittedUserRequiringService::class,
        ];
    }
}
