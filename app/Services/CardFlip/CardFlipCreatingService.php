<?php

namespace App\Services\CardFlip;

use App\Models\Card;
use App\Models\CardFlip;
use App\Relation;
use App\Services\Card\CardFindingService;
use App\Services\RequiredItem\RequiredItemListingService;
use FunctionalCoding\Service;

class CardFlipCreatingService extends Service
{
    public static function getBindNames()
    {
        return [
            'card' => 'card for {{card_id}}',

            'card_flip' => 'flip of {{card}}',

            'free_flippable_card' => 'free flippable card for {{card_id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [
            'result.card' => function ($authUser, $card) {
                if ($card->{Card::SHOWNER_ID} == $authUser->getKey()) {
                    $card->touch();
                }
            },
        ];
    }

    public static function getLoaders()
    {
        return [
            'card' => function ($authUser, $cardId) {
                return [CardFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $cardId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{card_id}}',
                ]];
            },

            'card_flip' => function ($authUser, $card) {
                return CardFlip::query()
                    ->where(CardFlip::USER_ID, $authUser->getKey())
                    ->where(CardFlip::CARD_ID, $card->getKey())
                    ->first()
                ;
            },

            'free_flippable_card' => function ($card, $requiredItems) {
                return $requiredItems->isEmpty() ? $card : null;
            },

            'required_coin' => function ($requiredItems) {
                return $requiredItems->where('type', 'coin')->first();
            },

            'required_items' => function ($authUser, $card) {
                return [RequiredItemListingService::class, [
                    'auth_user' => $authUser,
                    'related' => $card,
                    'related_id' => $card->getKey(),
                    'related_type' => array_flip(Relation::morphMap())[get_class($card)],
                ], [
                    'auth_user' => '{{auth_user}}',
                    'related' => '{{card}}',
                    'related_id' => '{{card_id}}',
                    'related_type' => array_flip(Relation::morphMap())[get_class($card)],
                ]];
            },

            'result' => function ($authUser, $card) {
                return (new CardFlip())->create([
                    CardFlip::CARD_ID => $card->getKey(),
                    CardFlip::USER_ID => $authUser->getKey(),
                ]);
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [
            'result' => ['card_flip', 'free_flippable_card'],
        ];
    }

    public static function getRuleLists()
    {
        return [
            'auth_user' => ['required'],

            'card_flip' => ['null'],

            'card_id' => ['required', 'integer'],

            'free_flippable_card' => ['not_null'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
