<?php

namespace App\Services\Keyword\WeightRange;

use App\Database\Models\Keyword\WeightRange;
use App\Service;
use App\Services\ListingService;

class WeightRangeListingService extends Service {

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
            }],

            'query.min' => ['query', 'min', function ($query, $min) {

                $query->qWhere('min', $min);
                $query->qOrderBy('min', 'asc');
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return WeightRange::class;
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
            'min'
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
