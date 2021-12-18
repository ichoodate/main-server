<?php

namespace App\Services\Keyword\Residence;

use App\Models\Keyword\Residence;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class ResidenceFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'residence keyword for {{id}}',
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
                return ['parentObj.concrete', 'relatedObj.concrete'];
            },

            'model_class' => function () {
                return Residence::class;
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
