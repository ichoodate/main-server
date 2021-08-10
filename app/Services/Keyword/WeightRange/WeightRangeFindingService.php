<?php

namespace App\Services\Keyword\WeightRange;

use App\Database\Models\Keyword\WeightRange;
use App\Services\FindingService;
use FunctionalCoding\Service;

class WeightRangeFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'weight_range keyword for {{id}}',
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
        return [];
    }

    public static function getArrTraits()
    {
        return [
            FindingService::class,
        ];
    }
}
