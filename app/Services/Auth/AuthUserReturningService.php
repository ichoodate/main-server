<?php

namespace App\Services\Auth;

use App\Database\Models\User;
use App\Service;
use App\Services\FindingService;

class AuthUserReturningService extends Service {

    public static function getArrBindNames()
    {
        return [
            'available_expands'
                => 'options for {{expands}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'result' => ['result', 'expands', function ($result, $expands) {

                if ( ! is_null($result) )
                {
                    return;
                }

                $collection = $result->newCollection();

                $collection->push($result);
                $collection->load($expands);
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => [function () {

                return [
                    'invoices', 'profilePhotos'
                ];
            }],

            'result' => [function () {

                return auth()->user();
            }]
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
        return [];
    }

}
