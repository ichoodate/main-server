<?php

namespace App\Services\Item;

use App\Models\Item;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class ItemFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'item for {{id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'model_class' => function () {
                return Item::class;
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [];
    }

    public static function getTraits()
    {
        return [
            FindService::class,
        ];
    }
}
