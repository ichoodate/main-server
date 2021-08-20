<?php

namespace App\Services\UserIdealTypeKwdPvt;

use App\Models\UserIdealTypeKwdPvt;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class IdealTypeKeywordListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => function ($authUser, $query) {
                $query->qWhere(UserIdealTypeKwdPvt::USER_ID, $authUser->getKey());
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
                return UserIdealTypeKwdPvt::class;
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
            ListService::class,
        ];
    }
}
