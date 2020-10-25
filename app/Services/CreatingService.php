<?php

namespace App\Services;

use App\Services\DuplicationCheckingService;
use Illuminate\Extend\Service;

class CreatingService extends Service {

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
            'created' => [function () {

                throw new \Exception;
            }],

            'result' => ['created', function ($created) {

                return $created;
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
        return [];
    }

}
