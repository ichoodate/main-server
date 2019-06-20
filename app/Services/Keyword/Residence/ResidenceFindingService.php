<?php

namespace App\Services\Keyword\Residence;

use App\Database\Models\Keyword\Residence;
use App\Service;
use App\Services\FindingService;

class ResidenceFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'residence keyword for {{id}}'
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

                return Residence::class;
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
