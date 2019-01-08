<?php

namespace App\Services\RequiredCoin;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Database\Models\RequiredCoin;
use App\Service;
use App\Services\NowTimezoneService;
use App\Services\Card\CardFindingService;

class CardActivityRequiredCoinCountingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'card'
                => 'card of {{card_id}}',

            'card_flip'
                => 'flip status of {{card}} acted by {{auth_user}}',

            'match_open'
                => 'open status of {{card}} acted by {{auth_user}}',

            'match_propose'
                => 'propose status of {{card}} acted by {{auth_user}}'
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

                return inst(Activity::class)->aliasQuery()
                    ->qWhere(Activity::RELATED_ID, $card->getKey())
                    ->qWhere(Activity::USER_ID, $authUser->getKey())
                    ->qWhere(Activity::TYPE, Activity::TYPE_CARD_FLIP)
                    ->first();
            }],

            'match_open' => ['auth_user', 'card', function ($authUser, $card) {

                return inst(Activity::class)->aliasQuery()
                    ->qWhere(Activity::RELATED_ID, $card->{Card::MATCH_ID})
                    ->qWhere(Activity::USER_ID, $authUser->getKey())
                    ->qWhere(Activity::TYPE, Activity::TYPE_MATCH_OPEN)
                    ->first();
            }],

            'match_propose' => ['auth_user', 'card', function ($authUser, $card) {

                return inst(Activity::class)->aliasQuery()
                    ->qWhere(Activity::RELATED_ID, $card->{Card::MATCH_ID})
                    ->qWhere(Activity::USER_ID, $authUser->getKey())
                    ->qWhere(Activity::TYPE, Activity::TYPE_MATCH_PROPOSE)
                    ->first();
            }],

            'evaluated_count' => ['card', 'limited_min_time', 'auth_user', 'type', function ($card, $limitedMinTime, $authUser, $type) {

                if ( $card->{Card::CHOOSER_ID} == $authUser->getKey() )
                {
                    $cardQuery = inst(Card::class)->aliasQuery()
                        ->qSelect([Card::ID])
                        ->qWhere(Card::GROUP_ID, $card->{Card::GROUP_ID})
                        ->getQuery();

                    return inst(Activity::class)->aliasQuery()
                        ->lockForUpdate()
                        ->qWhereIn(Activity::RELATED_ID, $cardQuery)
                        ->qWhere(Activity::USER_ID, $authUser->getKey())
                        ->qWhere(Activity::TYPE, $type)
                        ->count();
                }
                else // if ( $card->{Card::SHOWNER_ID} == $authUser->getKey() )
                {
                    return inst(Activity::class)->aliasQuery()
                        ->lockForUpdate()
                        ->qWhere(Activity::USER_ID, $authUser->getKey())
                        ->qWhere(Activity::TYPE, $type)
                        ->qWhere(Activity::CREATED_AT, '>=', $limitedMinTime)
                        ->count();
                }
                // throw new Exception;
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

            'is_free' => ['is_free_count', 'is_free_time', function ($isFreeCount, $isFreeTime) {

                return $isFreeCount && $isFreeTime;
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

            'limited_max_count' => ['is_chooser', 'type', function ($isChooser, $type) {

                if ( $isChooser )
                {
                    if ( $type == Activity::TYPE_CARD_FLIP )
                    {
                        return 2;
                    }
                    else if ( $type == Activity::TYPE_CARD_OPEN )
                    {
                        return 1;
                    }
                    else if ( $type == Activity::TYPE_CARD_PROPOSE )
                    {
                        return 1;
                    }

                    throw new \Exception;
                }
                else // if ( ! $isChooser )
                {
                    return INF;
                }
            }],

            'limited_min_time' => ['is_chooser', 'now_timezone_time', function ($isChooser, $nowTimezoneTime) {

                if ( $isChooser )
                {
                    return app(\DateTime::class, [$nowTimezoneTime])->format('Y-m-d 00:00:00');
                }
                else
                {
                    return app(\DateTime::class, [$nowTimezoneTime])
                        ->modify('-1 day')
                        ->modify('+1 second')
                        ->format('Y-m-d H:i:s');
                }
            }],

            'price' => ['type', function ($type) {

                if ( $type == Activity::TYPE_CARD_FLIP )
                {
                    return 5;
                }
                else if ( $type == Activity::TYPE_CARD_OPEN )
                {
                    return 5;
                }
                else if ( $type == Activity::TYPE_CARD_PROPOSE )
                {
                    return 5;
                }

                throw new \Exception;
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
            'card_flip'
                => ['null_if:{{type}},' . Activity::TYPE_CARD_FLIP, 'not_null_if:{{type}},' . Activity::TYPE_CARD_OPEN],

            'card_id'
                => ['required', 'integer'],

            'match_open'
                => ['null_if:{{type}},' . Activity::TYPE_CARD_OPEN, 'not_null_if:{{type}},' . Activity::TYPE_CARD_PROPOSE],

            'match_propose'
                => ['null_if:{{type}},' . Activity::TYPE_CARD_PROPOSE],

            'type'
                => ['in:' . implode(',', [Activity::TYPE_CARD_FLIP, Activity::TYPE_CARD_OPEN, Activity::TYPE_CARD_PROPOSE])]
        ];
    }

    public static function getArrTraits()
    {
        return [
            NowTimezoneService::class,
            RequiredCoinCountingService::class
        ];
    }

}
