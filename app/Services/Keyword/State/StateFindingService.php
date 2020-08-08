<?php

namespace App\Services\Keyword\State;

use App\Database\Models\Keyword\State;
use App\Service;
use App\Services\FindingService;

class StateFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'state keyword for {{id}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => [function () {

                return ['country', 'residence'];
            }],

            'model_class' => [function () {

                return State::class;
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
