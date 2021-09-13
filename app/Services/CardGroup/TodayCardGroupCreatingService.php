<?php

namespace App\Services\CardGroup;

use App\Models\CardGroup;
use App\Models\IdealTypeKeyword;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Card\CardListCreatingService;
use App\Services\User\MatchingUserListingService;
use FunctionalCoding\Service;

class TodayCardGroupCreatingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'auth_user' => 'authorized user',

            'ideal_type_keyword_ids' => 'ideal type keyword ids of {{auth_user}}',

            'today_card_group' => 'card group created in today',
        ];
    }

    public static function getArrCallbacks()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'auth_token' => $authToken,
                ], [
                    'auth_token' => '{{auth_token}}',
                ]];
            },

            'cards' => function ($authUser, $result, $users) {
                return [CardListCreatingService::class, [
                    'auth_user' => $authUser,
                    'card_group' => $result,
                    'users' => $users,
                ]];
            },

            'ideal_type_keyword_ids' => function ($idealTypeKeywords) {
                return $idealTypeKeywords->pluck(IdealTypeKeyword::KEYWORD_ID)->all();
            },

            'ideal_type_keywords' => function ($authUser) {
                return (new IdealTypeKeyword())->query()
                    ->where(IdealTypeKeyword::USER_ID, $authUser->getKey())
                    ->get()
                ;
            },

            'result' => function ($authUser) {
                return (new CardGroup())->create([
                    CardGroup::USER_ID => $authUser->getKey(),
                    CardGroup::TYPE => 'daily',
                ]);
            },

            'today_card_group' => function ($authUser, $timezone) {
                $time = (new \DateTime('now', new \DateTimeZone($timezone)))
                    ->setTime(0, 0)
                    ->setTimezone(new \DateTimeZone('UTC'))
                ;

                $query = (new CardGroup())->query()
                    ->select(CardGroup::ID)
                    ->where(CardGroup::USER_ID, $authUser->getKey())
                    ->getQuery()
                ;

                return (new CardGroup())->query()
                    ->whereIn(CardGroup::ID, $query)
                    ->where(CardGroup::TYPE, 'daily')
                    ->where(CardGroup::CREATED_AT, '>=', $time->format('Y-m-d H:i:s'))
                    ->first()
                ;
            },

            'users' => function ($authUser, $idealTypeKeywordIds) {
                return [MatchingUserListingService::class, [
                    'auth_user' => $authUser,
                    'keyword_ids' => implode(',', $idealTypeKeywordIds),
                    'limit' => 4,
                    'strict' => false,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'keyword_ids' => '{{ideal_type_keyword_ids}}',
                    'limit' => 'card limit count for {{today_card_group}}',
                    'strict' => 'strict user search mode operator for {{ideal_type_keyword_ids}}',
                ]];
            },

            'users_count' => function ($users) {
                $count = $users->count();

                if ($count < 4) {
                    throw new \Exception();
                }

                return $count;
            },
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'today_card_group' => ['null'],

            'timezone' => ['required', 'timezone'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
