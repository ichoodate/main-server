<?php

namespace App\Services;

use App\Service;
use App\Services\AuthUserRequiringService;

class PermittedUserRequiringService extends Service {

    public static function getArrBindNames()
    {
        return [
            'permitted_user'
                => '{{auth_user}} who is owner of {{model}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'permitted_user' => [function () {

                throw new \Exception;
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
            'permitted_user'
                => ['required']
        ];
    }

    public static function getArrTraits()
    {
        return [
            AuthUserRequiringService::class
        ];
    }

}
