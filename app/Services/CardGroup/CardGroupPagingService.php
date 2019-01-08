<?php

namespace App\Services\CardGroup;

use App\Database\Models\CardGroup;
use App\Services\AuthUserRequiringService;
use App\Service;

class CardGroupPagingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => ['query', 'auth_user', function ($query, $authUser) {

                $query->qWhere(CardGroup::USER_ID, $authUser->getKey());
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return CardGroup::class;
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
            AuthUserRequiringService::class,
            PagingService::class
        ];
    }

}
