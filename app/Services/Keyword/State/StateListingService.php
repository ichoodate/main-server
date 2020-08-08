<?php

namespace App\Services\Keyword\State;

use App\Database\Models\Keyword\State;
use App\Service;
use App\Services\ListingService;
use App\Services\Keyword\Country\CountryFindingService;
use App\Services\Keyword\State\StateFindingService;

class StateListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.country' => ['query', 'country', function ($query, $country) {
                $query->qWhere(State::COUNTRY_ID, $country->getKey());
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => [function () {

                return ['country', 'residence'];
            }],

            'country' => ['country_id', function ($countryId) {

                return [CountryFindingService::class, [
                    'id'
                        => $countryId
                ], [
                    'id'
                        => '{{country_id}}'
                ]];
            }],

            'cursor' => ['cursor_id', function ($cursorId) {

                return [StateFindingService::class, [
                    'id'
                        => $cursorId
                ], [
                    'id'
                        => '{{cursor_id}}'
                ]];
            }],

            'model_class' => [function () {

                return State::class;
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
            'country_id'
                => ['required', 'integer']
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListingService::class
        ];
    }

}
