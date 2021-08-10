<?php

namespace App\Services;

use FunctionalCoding\Service;

class PermittedUserRequiringService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'permitted_user' => '{{auth_user}} who is related user of {{model}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'permitted_user' => function ($authUser, $model) {
                throw new \Exception();
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

            'permitted_user' => ['required'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
