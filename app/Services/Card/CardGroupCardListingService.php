<?php

namespace App\Services\Card;

use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Service;
use App\Services\ListingService;
use App\Services\CardGroup\CardGroupFindingService;

class CardGroupCardListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.card_group' => ['query', 'card_group', function ($query, $cardGroup) {

                $query->qWhere(Card::GROUP_ID, $cardGroup->getKey());
            }],
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'card_group' => ['auth_user', 'card_group_id', function ($authUser, $cardGroupId) {

                return [CardGroupFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $cardGroupId
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => '{{card_group_id}}'
                ]];
            }],

            'model_class' => [function () {

                return Card::class;
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'card_group_id'
                => ['required', 'integer']
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListingService::class
        ];
    }

}
