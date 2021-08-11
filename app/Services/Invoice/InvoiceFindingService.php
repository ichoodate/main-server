<?php

namespace App\Services\Invoice;

use App\Models\Invoice;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\Service;

class InvoiceFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'invoice for {{id}}',
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
