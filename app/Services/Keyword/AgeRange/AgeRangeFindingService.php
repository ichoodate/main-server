<?php

namespace App\Services\Keyword\AgeRange;

use App\Database\Models\Keyword\AgeRange;
use Illuminate\Extend\Service;
use App\Services\FindingService;

class AgeRangeFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'age_range keyword for {{id}}',
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
