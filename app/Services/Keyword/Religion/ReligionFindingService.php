<?php

namespace App\Services\Keyword\Religion;

use App\Database\Models\Keyword\Religion;
use App\Services\FindingService;
use Illuminate\Extend\Service;

class ReligionFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'religion keyword for {{id}}',
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
                return Religion::class;
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
