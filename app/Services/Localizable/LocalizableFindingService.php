<?php

namespace App\Services\Localizable;

use App\Models\Localizable;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class LocalizableFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'localizable for {{id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
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
