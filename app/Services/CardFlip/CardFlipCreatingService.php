<?php

namespace App\Services\CardFlip;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use Illuminate\Extend\Service;
use App\Services\UsedCoinAddingService;
use App\Services\Card\CardFindingService;
use App\Services\Card\FreeFlippableChooserCardReturningService;
use App\Services\Card\FreeFlippableShownerCardReturningService;

class CardFlipCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'card'
                => 'card for {{card_id}}',

            'card_flip'
                => '{{auth_user}}\'s flip activity about {{card}}',

            'free_flippable_card'
                => 'free flippable card for {{card_id}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'created.card' => function ($authUser, $card) {

                if ( $card->{Card::SHOWNER_ID} == $authUser->getKey() )
                {
                    $card->touch();
                }
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'card' => function ($authUser, $cardId) {

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
            },

            'card_flip' => function ($authUser, $card) {

                return CardFlip::query()
                    ->where(CardFlip::USER_ID, $authUser->getKey())
                    ->where(CardFlip::CARD_ID, $card->getKey())
                    ->first();
            },

            'created' => function ($authUser, $card) {

                return (new CardFlip)->create([
                    CardFlip::CARD_ID => $card->getKey(),
                    CardFlip::USER_ID => $authUser->getKey()
                ]);
            },

            'free_flippable_card' => function ($authUser, $card) {

                if ( $card->{Card::CHOOSER_ID} == $authUser->getKey() )
                {
                    return [FreeFlippableChooserCardReturningService::class, [
                        'auth_user'
                            => $authUser,
                        'card'
                            => $card
                    ], [
                        'auth_user'
                            => '{{auth_user}}',
                        'card'
                            => '{{card}}'
                    ]];
                }
                else
                {
                    return [FreeFlippableShownerCardReturningService::class, [
                        'auth_user'
                            => $authUser,
                        'card'
                            => $card
                    ], [
                        'auth_user'
                            => '{{auth_user}}',
                        'card'
                            => '{{card}}'
                    ]];
                }
            },
        ];
    }

    public static function getArrPromiseLists()
    {
        return [
            'created'
                => ['card_flip', 'free_flippable_card'],
        ];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user'
                => ['required'],

            'card_id'
                => ['required', 'integer'],

            'card_flip'
                => ['null']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
