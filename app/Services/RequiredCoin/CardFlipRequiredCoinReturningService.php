<?php

namespace App\Services\RequiredCoin;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use App\Database\Models\CardGroup;
use App\Database\Models\RequiredCoin;
use App\Service;
use App\Services\Card\CardFindingService;
use App\Services\RequiredCoin\RequiredCoinReturningService;

class CardFlipRequiredCoinReturningService extends Service {

    public static function getArrBindNames()
    {
        return [
            'card'
                => 'card for {{card_id}}',

            'card_flip'
                => 'flip status acted by {{auth_user}} for {{card}}'
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
                        => '{{card_id}}'
                ]];
            }],

            'card_flip' => ['auth_user', 'card', function ($authUser, $card) {

                return inst(CardFlip::class)->query()
                    ->qWhere(CardFlip::CARD_ID, $card->getKey())
                    ->qWhere(CardFlip::USER_ID, $authUser->getKey())
                    ->first();
            }],

            'evaluated_count' => ['card', 'is_chooser', 'auth_user', function ($card, $isChooser, $authUser) {

                if ( $isChooser )
                {
                    $cardQuery = inst(Card::class)->query()
                        ->qSelect([Card::ID])
                        ->qWhere(Card::GROUP_ID, $card->{Card::GROUP_ID})
                        ->getQuery();

                    return inst(CardFlip::class)->query()
                        ->lockForUpdate()
                        ->qWhereIn(CardFlip::CARD_ID, $cardQuery)
                        ->qWhere(CardFlip::USER_ID, $authUser->getKey())
                        ->count();
                }

                return 0;
            }],

            'evaluated_time' => ['timezone', 'is_chooser', 'card', function ($timezone, $isChooser, $card) {

                if ( $isChooser )
                {
                    $datetime = new \DateTime($card->{Card::CREATED_AT});
                }
                else
                {
                    $datetime = new \DateTime($card->{Card::UPDATED_AT});
                }

                $datetime->setTimezone(new \DateTimeZone($timezone));

                return $datetime->format('Y-m-d H:i:s');
            }],

            'is_free_count' => ['limited_max_count', 'evaluated_count', function ($limitedMaxCount, $evaluatedCount) {

                return $limitedMaxCount > $evaluatedCount;
            }],

            'is_free_time' => ['limited_min_time', 'evaluated_time', function ($limitedMinTime, $evaluatedTime) {

                return strtotime($limitedMinTime) <= strtotime($evaluatedTime);
            }],

            'is_chooser' => ['auth_user', 'card', function ($authUser, $card) {

                return $card->{Card::CHOOSER_ID} == $authUser->getKey();
            }],

            'limited_max_count' => ['is_chooser', function ($isChooser) {

                return $isChooser ? 2 : INF;
            }],

            'limited_min_time' => ['is_chooser', 'timezone', function ($isChooser, $timezone) {

                $time = new \DateTime('now', new \DateTimeZone($timezone));

                if ( $isChooser )
                {
                    return inst(\DateTime::class, [$time])->format('Y-m-d 00:00:00');
                }
                else
                {
                    return inst(\DateTime::class, [$time->format('Y-m-d H:i:s')])
                        ->modify('-1 day')
                        ->modify('+1 second')
                        ->format('Y-m-d H:i:s');
                }
            }],

            'reason' => ['is_chooser', 'is_free_count', 'is_free_time', function ($isChooser, $isFreeCount, $isFreeTime) {

                if ( !$isChooser && !$isFreeTime )
                {
                    return 'card flip time is passed more than 24 hours after matching-user flip same card.';
                }
                else if ( $isChooser && !$isFreeTime )
                {
                    return 'card flip date is passed than card creation date.';
                }
                else if ( $isChooser && !$isFreeCount )
                {
                    return 'card flip count is more than limited free count in card group.';
                }
            }],

            'result' => ['is_free', 'reason', function ($isFree, $reason) {

                return $isFree ? null : [
                    'price' => 5,
                    'reason' => $reason
                ]
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
            'auth_user'
                => ['required'],

            'card_flip'
                => ['null'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
