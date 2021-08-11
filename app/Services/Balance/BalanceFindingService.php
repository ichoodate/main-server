<?php

namespace App\Services\Balance;

use App\Models\Balance;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\Illuminate\Service\FindService;
use FunctionalCoding\Service;

class BalanceFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'balance for {{id}}',
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
                return Balance::class;
            },

            'permitted_user' => function ($authUser, $model) {
                if (in_array($authUser->getKey(), [$model->{Balance::USER_ID}])) {
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
