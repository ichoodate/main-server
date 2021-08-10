<?php

namespace App\Services\Card;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use FunctionalCoding\Service;

class FreeFlippableChooserCardReturningService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'evaluated_count' => function ($authUser, $card) {
                $cardQuery = (new Card())->query()
                    ->qSelect([Card::ID])
                    ->qWhere(Card::GROUP_ID, $card->{Card::GROUP_ID})
                    ->getQuery()
                ;

                return (new CardFlip())->query()
                    ->lockForUpdate()
                    ->qWhereIn(CardFlip::CARD_ID, $cardQuery)
                    ->qWhere(CardFlip::USER_ID, $authUser->getKey())
                    ->count()
                ;
            },

            'evaluated_time' => function ($card) {
                return $card->{Card::CREATED_AT};
            },

            'is_free' => function ($isFreeCount, $isFreeTime) {
                return $isFreeCount && $isFreeTime;
            },

            'is_free_count' => function ($evaluatedCount, $limitedMaxCount) {
                return $limitedMaxCount > $evaluatedCount;
            },

            'limited_max_count' => function () {
                return 2;
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
            FreeFlippableCardReturningService::class,
        ];
    }
}
