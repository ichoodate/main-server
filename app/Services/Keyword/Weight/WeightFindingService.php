<?php

namespace App\Services\Keyword\Weight;

use App\Models\Keyword\Weight;
use App\Services\FindingService;
use FunctionalCoding\Service;

class WeightFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'weight keyword for {{id}}',
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
                return Weight::class;
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
