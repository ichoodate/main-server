<?php

namespace App\Services\Keyword\StatureRange;

use App\Database\Models\Keyword\StatureRange;
use App\Services\FindingService;
use Illuminate\Extend\Service;

class StatureRangeFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'stature_range keyword for {{id}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
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
        return [];
    }

    public static function getArrTraits()
    {
        return [
            FindingService::class,
        ];
    }
}
