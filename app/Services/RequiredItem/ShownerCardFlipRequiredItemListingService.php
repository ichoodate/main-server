<?php

namespace App\Services\RequiredItem;

use App\Models\Card;
use App\Models\RequiredItem;
use FunctionalCoding\Service;

class ShownerCardFlipRequiredItemListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbacks()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'card' => function () {
                throw new \Exception();
            },

            'evaluated_time' => function ($card) {
                return $card->{Card::UPDATED_AT};
            },

            'free_min_time' => function () {
                return (new \DateTime())
                    ->modify('-1 day')
                    ->modify('+1 second')
                    ->format('Y-m-d H:i:s')
                ;
            },

            'is_free' => function ($evaluatedTime, $freeMinTime) {
                return strtotime($freeMinTime) <= strtotime($evaluatedTime);
            },

            'result' => function ($card, $isFree) {
                if (!$isFree) {
                    return RequiredItem::where('type', 'card_flip')->get();
                }

                return RequiredItem::where('type', 'none')->get();
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
        return [];
    }
}
