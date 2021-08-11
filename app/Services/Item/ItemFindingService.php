<?php

namespace App\Services\Item;

use App\Models\Item;
use FunctionalCoding\Illuminate\Service\FindService;
use FunctionalCoding\Service;

class ItemFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'item for {{id}}',
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
            FindService::class,
        ];
    }
}
