<?php

namespace App\Services\RequiredItem;

use App\Models\Card;
use App\Models\CardFlip;
use App\Models\RequiredItem;
use FunctionalCoding\Service;

class ChooserCardFlipRequiredItemListingService extends Service
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
            'card' => function () {
                throw new \Exception();
            },

            'evaluated_count' => function ($authUser, $card) {
                $cardQuery = (new Card())->query()
                    ->select([Card::ID])
                    ->where(Card::GROUP_ID, $card->{Card::GROUP_ID})
                    ->getQuery()
                ;

                return (new CardFlip())->query()
                    ->lockForUpdate()
                    ->whereIn(CardFlip::CARD_ID, $cardQuery)
                    ->where(CardFlip::USER_ID, $authUser->getKey())
                    ->count()
                ;
            },

            'evaluated_time' => function ($card) {
                return $card->{Card::CREATED_AT};
            },

            'free_max_count' => function () {
                return 2;
            },

            'free_min_time' => function () {
                return (new \DateTime())
                    ->modify('-1 day')
                    ->modify('+1 second')
                    ->format('Y-m-d H:i:s')
                ;
            },

            'is_free' => function ($isFreeCount, $isFreeTime) {
                return $isFreeCount && $isFreeTime;
            },

            'is_free_count' => function ($evaluatedCount, $freeMaxCount) {
                return $freeMaxCount > $evaluatedCount;
            },

            'is_free_time' => function ($evaluatedTime, $freeMinTime) {
                return strtotime($freeMinTime) <= strtotime($evaluatedTime);
            },

            'result' => function ($isFree) {
                if (!$isFree) {
                    return RequiredItem::where('when', 'card_flip')->get();
                }

                return RequiredItem::where('when', 'none')->get();
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
            'auth_user' => ['required'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
