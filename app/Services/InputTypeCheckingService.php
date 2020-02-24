<?php

namespace App\Services;

use App\Service;

class InputTypeCheckingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'result' => [function () {

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
            'type'
                => ['required', 'in_array:types']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
