<?php

namespace App\Services\Popularity;

use App\Database\Models\Popularity;
use App\Service;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;

class PopularityFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'popularity for {{id}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return Popularity::class;
            }],

            'permitted_user' => ['auth_user', 'model', function ($authUser, $model) {

                if ( in_array($authUser->getKey(), [
                    $model->{Popularity::SENDER_ID}, $model->{Popularity::RECEIVER_ID}
                ]) )
                {
                    return $authUser;
                }
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
        return [
            FindingService::class,
            PermittedUserRequiringService::class,
        ];
    }

}
