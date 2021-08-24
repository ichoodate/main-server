<?php

namespace App\Services\Keyword\Nationality;

use App\Models\Keyword\Nationality;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class NationalityFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'nationality keyword for {{id}}',
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
                return ['country'];
            },

            'model_class' => function () {
                return Nationality::class;
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
