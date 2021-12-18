<?php

namespace App\Services\Keyword\WeightRange;

use App\Models\Keyword\WeightRange;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class MaxWeightRangeListingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'query.min' => function ($min, $query) {
                $query->where('min', $min);
            },
        ];
    }

    public static function getLoaders()
    {
        return [
            'available_expands' => function () {
                return [];
            },

            'model_class' => function () {
                return WeightRange::class;
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'min' => ['required', 'integer'],
        ];
    }

    public static function getTraits()
    {
        return [
            ListService::class,
        ];
    }
}
