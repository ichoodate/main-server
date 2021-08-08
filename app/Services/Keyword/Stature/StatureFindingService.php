<?php

namespace App\Services\Keyword\Stature;

use App\Database\Models\Keyword\Stature;
use App\Services\FindingService;
use Illuminate\Extend\Service;

class StatureFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'stature keyword for {{id}}',
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
            FindingService::class,
        ];
    }
}
