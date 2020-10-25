<?php

namespace App\Services\Keyword\Smoke;

use App\Database\Models\Keyword\Smoke;
use Illuminate\Extend\Service;
use App\Services\FindingService;

class SmokeFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'smoke keyword for {{id}}'
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

                return Smoke::class;
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
