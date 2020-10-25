<?php

namespace App\Services\Keyword\Career;

use App\Database\Models\Keyword\Career;
use Illuminate\Extend\Service;
use App\Services\FindingService;

class CareerFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'career keyword for {{id}}'
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

                return Career::class;
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
