<?php

namespace App\Services\Activity;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Services\Card\CardFindingService;
use App\Service;
use App\Services\CreatingService;
use App\Services\RequiredCoinExistingService;
use App\Services\RequiredCoin\CardActivityRequiredCoinCountingService;

class CardActivityCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'card'
                => 'card for {{card_id}}',

            'required_coin'
                => 'required coin for activity of {{card}}'
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

            'match_activity' => ['auth_user', 'card', 'type', function ($authUser, $card, $type) {

                if ( $type == Activity::TYPE_CARD_OPEN )
                {
                    return inst(Activity::class)->create([
                        Activity::RELATED_ID => $card->{Card::MATCH_ID},
                        Activity::USER_ID    => $authUser->getKey(),
                        Activity::TYPE       => Activity::TYPE_MATCH_OPEN
                    ]);
                }
                else if ( $type == Activity::TYPE_CARD_PROPOSE )
                {
                    return inst(Activity::class)->create([
                        Activity::RELATED_ID => $card->{Card::MATCH_ID},
                        Activity::USER_ID    => $authUser->getKey(),
                        Activity::TYPE       => Activity::TYPE_MATCH_PROPOSE
                    ]);
                }
            }],

            'created' => ['auth_user', 'card', 'type', function ($authUser, $card, $type) {

                return inst(Activity::class)->create([
                    Activity::RELATED_ID => $card->getKey(),
                    Activity::USER_ID    => $authUser->getKey(),
                    Activity::TYPE       => $type
                ]);
            }],

            'required_coin' => ['auth_user', 'card', 'type', 'timezone', function ($authUser, $card, $type, $timezone) {

                return [CardActivityRequiredCoinCountingService::class, [
                    'auth_user'
                        => $authUser,
                    'card'
                        => $card,
                    'card_id'
                        => $card->getKey(),
                    'type'
                        => $type,
                    'timezone'
                        => $timezone
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'card'
                        => '{{card}}',
                    'card_id'
                        => 'id of {{card}}',
                    'type'
                        => '{{type}}',
                    'timezone'
                        => '{{timezone}}'
                ]];
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [
            'created'
                => ['required_coin']
        ];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user'
                => ['required'],

            'card'
                => ['not_null'],

            'card_id'
                => ['required', 'integer'],

            'type'
                => ['in:' . implode(',', [Activity::TYPE_CARD_FLIP, Activity::TYPE_CARD_OPEN, Activity::TYPE_CARD_PROPOSE])]
        ];
    }

    public static function getArrTraits()
    {
        return [
            CreatingService::class,
            RequiredCoinExistingService::class
        ];
    }

}
