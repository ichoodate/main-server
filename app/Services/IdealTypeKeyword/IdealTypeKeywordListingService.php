<?php

namespace App\Services\IdealTypeKeyword;

use App\Models\IdealTypeKeyword;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class IdealTypeKeywordListingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'query.auth_user' => function ($authUser, $query) {
                $query->where(IdealTypeKeyword::USER_ID, $authUser->getKey());
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

            'available_expands' => function () {
                return ['keywordObj.concrete', 'user'];
            },

            'model_class' => function () {
                return IdealTypeKeyword::class;
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
            ListService::class,
        ];
    }
}
