<?php

namespace App\Services\Invoice;

use App\Models\Invoice;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class InvoiceFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'invoice for {{id}}',
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
                return ['user'];
            },

            'model_class' => function () {
                return Invoice::class;
            },

            'permitted_user' => function ($authUser, $model) {
                if (in_array($authUser->getKey(), [$model->{Invoice::USER_ID}])) {
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
