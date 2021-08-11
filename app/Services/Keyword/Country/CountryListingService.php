<?php

namespace App\Services\Keyword\Country;

use App\Models\Keyword\Country;
use App\Services\ListingService;
use FunctionalCoding\Service;

class CountryListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query' => function ($query) {
                $query->qOrderBy('name', 'asc');
            },

            'query.name' => function ($name, $query) {
                $query->qWhere('name', $name);
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
            ListingService::class,
        ];
    }
}
