<?php

namespace App\Services\Keyword\Weight;

use App\Database\Models\Keyword\Weight;
use Illuminate\Extend\Service;
use App\Services\FindingService;

class WeightFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'weight keyword for {{id}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return Weight::class;
            }]
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
            FindingService::class
        ];
    }

}
