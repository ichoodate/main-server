<?php

namespace App\Services\Keyword\State;

use App\Models\Keyword\State;
use App\Services\Keyword\Country\CountryFindingService;
use FunctionalCoding\Illuminate\Service\ListService;
use FunctionalCoding\Service;

class StateListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.country' => function ($country, $query) {
            },
        ];
    }

    public static function getArrLoaders()
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

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'country_id' => ['required', 'integer'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListService::class,
        ];
    }
}
