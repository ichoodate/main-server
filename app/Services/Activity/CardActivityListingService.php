<?php

namespace App\Services\Activity;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Services\Card\CardFindingService;
use App\Service;
use App\Services\ListingService;

class CardActivityListingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'card'
                => 'card for {{card_id}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.card' => ['query', 'card', function ($query, $card) {

                $query->qWhere(Activity::RELATED_ID, $card->{Card::ID});
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'card' => ['auth_user', 'card_id', function ($authUser, $cardId) {

                return [CardFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $cardId
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => '{{card_id}}'
                ]];
            }],

            'model_class' => [function () {

                return Activity::class;
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
            'card_id'
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
