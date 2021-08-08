<?php

namespace App\Services\Localizable;

use App\Database\Models\Localizable;
use App\Services\FindingService;
use Illuminate\Extend\Service;

class LocalizableFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'localizable for {{id}}',
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
                return Localizable::class;
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
