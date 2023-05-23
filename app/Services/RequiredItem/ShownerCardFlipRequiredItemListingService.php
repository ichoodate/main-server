<?php

namespace App\Services\RequiredItem;

use App\Models\Card;
use App\Models\RequiredItem;
use FunctionalCoding\Service;

class ShownerCardFlipRequiredItemListingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
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

            'result' => function ($isFree) {
                if (!$isFree) {
                    return RequiredItem::where('type', 'card_flip')->get();
                }

                return RequiredItem::where('type', 'none')->get();
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'card' => ['required'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
