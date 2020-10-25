<?php

namespace App\Services\Keyword\Nationality;

use App\Database\Models\Keyword\Nationality;
use Illuminate\Extend\Service;
use App\Services\FindingService;

class NationalityFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'nationality keyword for {{id}}'
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

                return ['country'];
            }],

            'model_class' => [function () {

                return Nationality::class;
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
