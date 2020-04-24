<?php

namespace App\Services\User;

use App\Database\Models\User;
use App\Service;
use App\Services\User\UserFindingService;

class MatchingUserFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'auth_user_gender'
                => 'gender of {{auth_user}}',

            'model_gender'
                => 'gender of {{model}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'auth_user_gender' => ['auth_user', function ($authUser) {

                return $authUser->{User::GENDER};
            }],

            'model_gender' => ['model', function ($model) {

                return $model->{User::GENDER};
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user'
                => ['required'],

            'auth_user_gender'
                => ['different:{{model_gender}}']
        ];
    }

    public static function getArrTraits()
    {
        return [
            UserFindingService::class
        ];
    }

}
