<?php

namespace App\Services\Localizable;

use App\Models\Localizable;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class LocalizableFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'localizable for {{id}}',
        ];
    }

    public static function getArrCallbacks()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {
                return ['keywordObj.concrete'];
            },

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
            FindService::class,
        ];
    }
}
