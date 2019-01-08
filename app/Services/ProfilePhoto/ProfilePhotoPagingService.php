<?php

namespace App\Services\ProfilePhoto;

use App\Database\Models\ProfilePhoto;
use App\Services\AuthUserRequiringService;
use App\Services\PagingService;
use App\Service;

class ProfilePhotoPagingService extends Service {

    public static function getArrBindNames()
    {
        return [
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => ['query', 'auth_user', function ($query, $authUser) {

                $query->qWhere(ProfilePhoto::USER_ID, $authUser->getKey());
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return ProfilePhoto::class;
            }],
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
