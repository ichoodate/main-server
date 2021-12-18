<?php

namespace App\Services\Keyword\Country;

use App\Models\Keyword\Country;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class CountryListingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
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
        return [
            'name' => ['string'],
        ];
    }

    public static function getTraits()
    {
        return [
            ListService::class,
        ];
    }
}
