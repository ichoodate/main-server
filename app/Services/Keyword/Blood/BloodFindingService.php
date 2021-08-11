<?php

namespace App\Services\Keyword\Blood;

use App\Models\Keyword\Blood;
use FunctionalCoding\Illuminate\Service\FindService;
use FunctionalCoding\Service;

class BloodFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'blood keyword for {{id}}',
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
                return Blood::class;
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
