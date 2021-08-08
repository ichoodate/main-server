<?php

namespace App\Services\Keyword\Stature;

use App\Database\Models\Keyword\Stature;
use App\Services\ListingService;
use Illuminate\Extend\Service;

class StatureListingService extends Service
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
                return Stature::class;
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
