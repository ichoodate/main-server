<?php

namespace App\Services\Keyword\AgeRange;

use App\Database\Models\Keyword\AgeRange;
use App\Service;
use App\Services\ListingService;

class MaxAgeRangeListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
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

                return AgeRange::class;
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
