<?php

namespace App\Services\Keyword\StatureRange;

use App\Models\Keyword\StatureRange;
use FunctionalCoding\Illuminate\Service\ListService;
use FunctionalCoding\Service;

class MaxStatureRangeListingService extends Service
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
                return StatureRange::class;
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
            ListService::class,
        ];
    }
}
