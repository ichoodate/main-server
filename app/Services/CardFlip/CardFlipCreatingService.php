<?php

namespace App\Services\CardFlip;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use App\Service;
use App\Services\CreatingService;
use App\Services\UsedCoinAddingService;
use App\Services\Card\CardFindingService;
use App\Services\RequiredCoin\CardFlipRequiredCoinReturningService;

class CardFlipCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'card'
                => 'card for {{card_id}}',

            'required_coin'
                => 'required coin for flip of {{card}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
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
                        => '{{card_id}}',
                ]];
            }],

            'created' => ['auth_user', 'card', function ($authUser, $card) {

                $return = inst(CardFlip::class)->create([
                    CardFlip::CARD_ID => $card->getKey(),
                    CardFlip::USER_ID => $authUser->getKey()
                ]);

                return $return;
            }],

            'required_coin' => ['auth_user', 'card', 'timezone', function ($authUser, $card, $timezone) {

                return [CardFlipRequiredCoinReturningService::class, [
                    'auth_user'
                        => $authUser,
                    'card'
                        => $card,
                    'card_id'
                        => $card->getKey(),
                    'timezone'
                        => $timezone
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'card'
                        => '{{card}}',
                    'card_id'
                        => '{{card_id}}',
                    'timezone'
                        => '{{timezone}}'
                ]];
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [
            'created'
                => ['required_coin']
        ];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user'
                => ['required'],

            'card_id'
                => ['required', 'integer'],

            'timezone'
                => ['required']
        ];
    }

    public static function getArrTraits()
    {
        return [
            CreatingService::class,
            UsedCoinAddingService::class
        ];
    }

}
