<?php

namespace App\Services\CardGroup;

use App\Models\CardGroup;
use App\Models\IdealTypeKeyword;
use App\Services\User\MatchingUserListingService;
use FunctionalCoding\Service;

class TodayCardGroupCreatingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'today_card_group' => 'card group created within date',

            'ideal_type_keyword_ids' => 'ideal type keyword ids of {{auth_user}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'created' => function ($authUser) {
                return (new CardGroup())->create([
                    CardGroup::USER_ID => $authUser->getKey(),
                    CardGroup::TYPE => CardGroup::TYPE_DAILY,
                ]);
            },

            'today_card_group' => function ($authUser) {
                $time = new \DateTime('now', new \DateTimeZone('UTC'));

                $query = (new CardGroup())->query()
                    ->qSelect(CardGroup::ID)
                    ->qWhere(CardGroup::USER_ID, $authUser->getKey())
                    ->getQuery()
                ;

                return (new CardGroup())->query()
                    ->qWhereIn(CardGroup::ID, $query)
                    ->qWhere(CardGroup::TYPE, CardGroup::TYPE_DAILY)
                    ->qWhere(CardGroup::CREATED_AT, '>=', $time->format('Y-m-d H:i:s'))
                    ->first()
                ;
            },

            'ideal_type_keyword_ids' => function ($idealTypeKeywords) {
                return $idealTypeKeywords->pluck(IdealTypeKeyword::KEYWORD_ID)->all();
            },

            'ideal_type_keywords' => function ($authUser) {
                return (new IdealTypeKeyword())->query()
                    ->qWhere(IdealTypeKeyword::USER_ID, $authUser->getKey())
                    ->get()
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
                ], [
                    'limit',
                    'strict',
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
            'auth_user' => ['required'],

            'today_card_group' => ['null'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            CardGroupCreatingService::class,
        ];
    }
}
