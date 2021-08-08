<?php

namespace App\Services\Card;

use App\Database\Models\Card;
use Illuminate\Extend\Service;

class FreeFlippableShownerCardReturningService extends Service
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
            'evaluated_time' => function ($card) {
                return $card->{Card::UPDATED_AT};
            },

            'is_free' => function ($isFreeTime) {
                return $isFreeTime;
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
