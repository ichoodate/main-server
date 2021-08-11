<?php

namespace App\Services\UserSelfKwdPvt;

use App\Models\UserSelfKwdPvt;
use App\Services\ListingService;
use FunctionalCoding\Service;

class UserSelfKwdPvtListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => function ($authUser, $query) {
                $query->qWhere(UserSelfKwdPvt::USER_ID, $authUser->getKey());
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {
                return ['keyword.concrete', 'user'];
            },

            'model_class' => function () {
                return UserSelfKwdPvt::class;
            },
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user' => ['required'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListingService::class,
        ];
    }
}
