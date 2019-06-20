<?php

namespace App\Services\Payment;

use App\Database\Models\Payment;
use App\Service;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;

class PaymentFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'payment for {{id}}'
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

                return Payment::class;
            }],

            'permitted_user' => ['auth_user', 'model', function ($authUser, $model) {

                if ( $model->{Payment::USER_ID} == $authUser->getkey() )
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
