<?php

namespace App\Services\Keyword\Country;

use App\Database\Models\Keyword\Country;
use Illuminate\Extend\Service;
use App\Services\ListingService;
use App\Services\Keyword\CountryFindingService;

class CountryListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query' => ['query', function ($query) {

                $query->qOrderBy('name', 'asc');
            }],

            'query.name' => ['query', 'name', function ($query, $name) {

                $query->qWhere('name', $name);
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => [function () {

                return ['state', 'residence', 'nationality'];
            }],

            'model_class' => [function () {

                return Country::class;
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'name'
                => ['string']
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListingService::class
        ];
    }

}
