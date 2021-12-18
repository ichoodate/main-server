<?php

namespace App\Services\Keyword\StatureRange;

use App\Models\Keyword\StatureRange;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class StatureRangeFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'stature_range keyword for {{id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
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
        return [];
    }

    public static function getTraits()
    {
        return [
            FindService::class,
        ];
    }
}
