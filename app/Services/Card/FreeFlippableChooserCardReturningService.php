<?php

namespace App\Services\Card;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use App\Service;
use App\Services\Card\FreeFlippableCardReturningService;

class FreeFlippableChooserCardReturningService extends Service {

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
            'evaluated_count' => ['auth_user', 'card', function ($authUser, $card) {

                $cardQuery = inst(Card::class)->query()
                    ->qSelect([Card::ID])
                    ->qWhere(Card::GROUP_ID, $card->{Card::GROUP_ID})
                    ->getQuery();

                return inst(CardFlip::class)->query()
                    ->lockForUpdate()
                    ->qWhereIn(CardFlip::CARD_ID, $cardQuery)
                    ->qWhere(CardFlip::USER_ID, $authUser->getKey())
                    ->count();
            }],

            'evaluated_time' => ['card', function ($card) {

                return $card->{Card::CREATED_AT};
            }],

            'is_free' => ['is_free_count', 'is_free_time', function ($isFreeCount, $isFreeTime) {

                return $isFreeCount && $isFreeTime;
            }],

            'is_free_count' => ['limited_max_count', 'evaluated_count', function ($limitedMaxCount, $evaluatedCount) {

                return $limitedMaxCount > $evaluatedCount;
            }],

            'limited_max_count' => [function () {

                return 2;
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
            FreeFlippableCardReturningService::class
        ];
    }

}
