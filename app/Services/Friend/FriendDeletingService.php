<?php

namespace App\Services\Friend;

use App\Models\Friend;
use App\Services\Auth\AuthUserFindingService;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\ORM\Eloquent\Service\Feature\ModelFeatureService;
use FunctionalCoding\Service;

class FriendDeletingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'result.model' => function ($model) {
                $model->delete();
            },
        ];
    }

    public static function getLoaders()
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
            ModelFeatureService::class,
            PermittedUserRequiringService::class,
        ];
    }
}
