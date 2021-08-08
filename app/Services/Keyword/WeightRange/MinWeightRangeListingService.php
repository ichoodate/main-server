<?php

namespace App\Services\Keyword\WeightRange;

use App\Database\Models\Keyword\WeightRange;
use Illuminate\Extend\Service;
use App\Services\ListingService;

class MinWeightRangeListingService extends Service {

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

                return WeightRange::class;
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
