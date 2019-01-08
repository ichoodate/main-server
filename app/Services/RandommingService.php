<?php

namespace App\Services;

use App\Service;

class RandommingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'limit' => [function () {

                throw new \Exception;
            }]
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.limit' => ['query', 'limit', function ($query, $limit) {

                $query->take($limit);
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'limit' => [function () {

                return 12;
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
            'limit' => ['integer', 'max:100']
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListingService::class
        ];
    }

}
