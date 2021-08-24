<?php

namespace App\Services\Keyword\Country;

use App\Models\Keyword\Country;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class CountryListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbacks()
    {
        return [
            'query' => function ($query) {
                $query->orderBy('name', 'asc');
            },

            'query.name' => function ($name, $query) {
                $query->where('name', $name);
            },
        ];
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
        return [
            'name' => ['string'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListService::class,
        ];
    }
}
