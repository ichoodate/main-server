<?php

namespace App\Services\Keyword\Drink;

use App\Database\Models\Keyword\Drink;
use App\Services\FindingService;
use Illuminate\Extend\Service;

class DrinkFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'drink keyword for {{id}}',
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
                return Drink::class;
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
