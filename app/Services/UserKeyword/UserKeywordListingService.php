<?php

namespace App\Services\UserKeyword;

use App\Models\UserKeyword;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class UserKeywordListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => function ($authUser, $query) {
                $query->qWhere(UserKeyword::USER_ID, $authUser->getKey());
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'token' => $authToken,
                ], [
                    'token' => '{{auth_token}}',
                ]];
            },

            'available_expands' => function () {
                return ['keyword.concrete', 'user'];
            },

            'model_class' => function () {
                return UserKeyword::class;
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
            ListService::class,
        ];
    }
}
