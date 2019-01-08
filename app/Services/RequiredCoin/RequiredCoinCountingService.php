<?php

namespace App\Services\RequiredCoin;

use App\Service;

class RequiredCoinCountingService extends Service {

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
            'is_free' => [function () {

                throw new \Exception;
            }],

            'result' => ['is_free', 'price', function ($isFree, $price) {

                return $isFree ? 0 : $price;
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
