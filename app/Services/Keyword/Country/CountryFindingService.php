<?php

namespace App\Services\Keyword\Country;

use App\Models\Keyword\Country;
use App\Services\FindingService;
use FunctionalCoding\Service;

class CountryFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'country keyword for {{id}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
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
