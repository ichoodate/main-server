<?php

namespace App\Services\Payment;

use App\Database\Models\Payment;
use Illuminate\Extend\Service;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;

class PaymentFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'payment for {{id}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {

                return ['item', 'user'];
            },

            'model_class' => function () {

                return Payment::class;
            },

            'permitted_user' => function ($authUser, $model) {

                if ( $model->{Payment::USER_ID} == $authUser->getkey() )
                {
                    return $authUser;
                }
            },
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
