<?php

namespace App\Services\Payment;

use App\Models\Payment;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class PaymentFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'payment for {{id}}',
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
                if ($model->{Payment::USER_ID} == $authUser->getkey()) {
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
            FindService::class,
            PermittedUserRequiringService::class,
        ];
    }
}
