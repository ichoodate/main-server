<?php

namespace App\Services\Keyword\Residence;

use App\Models\Keyword\Residence;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class ResidenceFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'residence keyword for {{id}}',
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
                return ['parentObj.concrete', 'relatedObj.concrete'];
            },

            'model_class' => function () {
                return Residence::class;
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
