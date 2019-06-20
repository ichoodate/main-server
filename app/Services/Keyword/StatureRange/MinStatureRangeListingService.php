<?php

namespace App\Services\Keyword\StatureRange;

use App\Database\Models\Keyword\StatureRange;
use App\Service;
use App\Services\ListingService;

class MinStatureRangeListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.max' => ['query', 'max', function ($query, $max) {

                $query->qWhere('max', $max);
                $query->qOrderBy('max', 'asc');
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return StatureRange::class;
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
            'max'
                => ['required', 'integer']
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListingService::class
        ];
    }

}
