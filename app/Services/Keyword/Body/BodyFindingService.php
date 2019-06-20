<?php

namespace App\Services\Keyword\Body;

use App\Database\Models\Keyword\Body;
use App\Service;
use App\Services\FindingService;

class BodyFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'body keyword for {{id}}'
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

                return Body::class;
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
