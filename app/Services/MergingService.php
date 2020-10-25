<?php

namespace App\Services;

use Illuminate\Extend\Service;

class MergingService extends Service {

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

            'existed' => [function () {

                throw new \Exception;
            }],

            'result' => ['created', 'existed', function ($created, $existed) {

                return $created->merge($existed);
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
