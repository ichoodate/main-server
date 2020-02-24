<?php

namespace App\Services\User;

use App\Database\Models\User;
use App\Service;
use App\Services\FindingService;

class UserFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'user for {{id}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return User::class;
            }]
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
            FindingService::class
        ];
    }

}
