<?php

namespace App\Services\Auth;

use Illuminate\Extend\Service;

class AuthSignOutService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'result' => function () {
                auth()->logout();
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'result' => function () {
                return true;
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
        return [];
    }
}
