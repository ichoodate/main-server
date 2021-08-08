<?php

namespace App\Services\Keyword\AgeRange;

use App\Database\Models\Keyword\AgeRange;
use Illuminate\Extend\Service;
use App\Services\ListingService;

class MinAgeRangeListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.max' => function ($max, $query) {

                $query->qWhere('max', $max);
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => function () {

                return AgeRange::class;
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
            'max'
                => ['required', 'integer']
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListingService::class,
        ];
    }

}
