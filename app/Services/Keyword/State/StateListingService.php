<?php

namespace App\Services\Keyword\State;

use App\Models\Keyword\State;
use App\Services\Keyword\Country\CountryFindingService;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class StateListingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'query.country' => function ($country, $query) {
                $query->where('country_id', $country->getKey());
            },
        ];
    }

    public static function getLoaders()
    {
        return [
            'available_expands' => function () {
                return ['country', 'residence'];
            },

            'country' => function ($countryId) {
                return [CountryFindingService::class, [
                    'id' => $countryId,
                ], [
                    'id' => '{{country_id}}',
                ]];
            },

            'cursor' => function ($cursorId) {
                return [StateFindingService::class, [
                    'id' => $cursorId,
                ], [
                    'id' => '{{cursor_id}}',
                ]];
            },

            'model_class' => function () {
                return State::class;
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
            'country_id' => ['required', 'integer'],
        ];
    }

    public static function getTraits()
    {
        return [
            ListService::class,
        ];
    }
}
