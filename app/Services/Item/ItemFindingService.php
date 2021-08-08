<?php

namespace App\Services\Item;

use App\Database\Models\Item;
use Illuminate\Extend\Service;
use App\Services\FindingService;

class ItemFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'item for {{id}}',
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

                return Item::class;
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
