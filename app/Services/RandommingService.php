<?php

namespace App\Services;

use Illuminate\Extend\Service;

class RandommingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.limit' => function ($limit, $query) {
                $query->take($limit);
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'limit' => function () {
                return 12;
            },

            'result' => function ($query) {
                return $query
                    ->orderByRaw('rand()')
                    ->get()
                ;
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
            'limit' => ['integer', 'max:100'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListingService::class,
        ];
    }
}
