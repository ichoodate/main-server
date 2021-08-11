<?php

namespace App\Services\Keyword\AgeRange;

use App\Models\Keyword\AgeRange;
use App\Services\ListingService;
use FunctionalCoding\Service;

class MaxAgeRangeListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.min' => function ($min, $query) {
                $query->qWhere('min', $min);
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
            'min' => ['required', 'integer'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListingService::class,
        ];
    }
}
