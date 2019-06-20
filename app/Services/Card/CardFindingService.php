<?php

namespace App\Services\Card;

use App\Database\Models\Card;
use App\Service;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;

class CardFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'card for {{id}}'
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

                return Card::class;
            }],

            'permitted_user' => ['auth_user', 'model', function ($authUser, $model) {

                if ( in_array($authUser->getKey(), [
                    $model->{Card::CHOOSER_ID}, $model->{Card::SHOWNER_ID}
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
            PermittedUserRequiringService::class,
            FindingService::class
        ];
    }

}
