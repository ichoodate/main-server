<?php

namespace App\Services\Keyword\StatureRange;

use App\Models\Keyword\StatureRange;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class MinStatureRangeListingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'query.max' => function ($max, $query) {
                $query->where('max', $max);
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
                return StatureRange::class;
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
            'max' => ['required', 'integer'],
        ];
    }

    public static function getTraits()
    {
        return [
            ListService::class,
        ];
    }
}
