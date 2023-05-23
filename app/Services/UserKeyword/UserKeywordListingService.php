<?php

namespace App\Services\UserKeyword;

use App\Models\UserKeyword;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class UserKeywordListingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'query.auth_user' => function ($authUser, $query) {
                $query->where(UserKeyword::USER_ID, $authUser->getKey());
            },
        ];
    }

    public static function getLoaders()
    {
        return [
            'available_expands' => function () {
                return ['keywordObj.concrete', 'user'];
            },

            'model_class' => function () {
                return UserKeyword::class;
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'auth_user' => ['required'],
        ];
    }

    public static function getTraits()
    {
        return [
            ListService::class,
        ];
    }
}
