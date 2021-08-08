<?php

namespace App\Services\Keyword\BirthYear;

use App\Database\Models\Keyword\BirthYear;
use Illuminate\Extend\Service;
use App\Services\FindingService;

class BirthYearFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'birth_year keyword for {{id}}',
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

                return BirthYear::class;
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
