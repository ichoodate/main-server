<?php

namespace App\Services\Keyword\AgeRange;

use App\Models\Keyword\AgeRange;
use App\Services\FindingService;
use FunctionalCoding\Service;

class AgeRangeFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'age_range keyword for {{id}}',
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
        return [];
    }

    public static function getArrTraits()
    {
        return [
            FindingService::class,
        ];
    }
}
