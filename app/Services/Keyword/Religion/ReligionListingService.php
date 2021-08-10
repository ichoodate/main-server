<?php

namespace App\Services\Keyword\Religion;

use App\Database\Models\Keyword\Religion;
use App\Services\ListingService;
use FunctionalCoding\Service;

class ReligionListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
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
            ListingService::class,
        ];
    }
}
