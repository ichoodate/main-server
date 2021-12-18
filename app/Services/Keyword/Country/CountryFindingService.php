<?php

namespace App\Services\Keyword\Country;

use App\Models\Keyword\Country;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class CountryFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'country keyword for {{id}}',
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
                return ['state', 'residence', 'nationality'];
            },

            'model_class' => function () {
                return Country::class;
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
