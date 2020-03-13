<?php

namespace App\Services\CardFlip;

use App\Database\Models\CardFlip;
use App\Service;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;

class CardFlipFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'card_flip for {{id}}'
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

                return CardFlip::class;
            }],

            'permitted_user' => ['auth_user', 'model', function ($authUser, $model) {

                if ( $authUser->getkey() == $model->{CardFlip::USER_ID} )
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
            PermittedUserRequiringService::class
        ];
    }

}
