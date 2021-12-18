<?php

namespace App\Services\Payment;

use App\Models\Payment;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class PaymentFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'payment for {{id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
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

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [];
    }

    public static function getTraits()
    {
        return [
            FindService::class,
            PermittedUserRequiringService::class,
        ];
    }
}
