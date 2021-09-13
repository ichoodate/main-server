<?php

namespace App\Services\CardFlip;

use App\Models\Card;
use App\Models\CardFlip;
use App\Models\Match;
use App\Models\User;
use App\Services\Auth\AuthUserFindingService;
use App\Services\User\MatchingUserFindingService;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class CardFlipListingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'flipper' => 'user for {{flipper_id}}',
        ];
    }

    public static function getArrCallbacks()
    {
        return [
            'query.match' => function ($query, $authUser, $relatedUser) {
                $subQuery1 = Match::query()
                    ->select(Match::ID)
                    ->where(User::GENDER_MAN == $relatedUser->{User::GENDER} ? Match::MAN_ID : Match::WOMAN_ID, $relatedUser->getKey())
                    ->where(User::GENDER_MAN == $authUser->{User::GENDER} ? Match::MAN_ID : Match::WOMAN_ID, $authUser->getKey())
                    ->getQuery()
                ;

                $subQuery2 = Card::query()
                    ->select(Card::ID)
                    ->whereIn(Card::MATCH_ID, $subQuery1)
                    ->getQuery()
                ;

                $query
                    ->whereIn(CardFlip::CARD_ID, $subQuery2)
                ;
            },

            'query.flipper' => function ($query, $flipper) {
                $query->where(CardFlip::USER_ID, $flipper->getKey());
            },
        ];
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

            'available_expands' => function () {
                return [];
            },

            'flipper' => function ($flipperId) {
                return User::find($flipperId);
            },

            'model_class' => function () {
                return CardFlip::class;
            },

            'related_user' => function ($authToken = '', $relatedUserId) {
                return [MatchingUserFindingService::class, [
                    'auth_token' => $authToken,
                    'id' => $relatedUserId,
                ], [
                    'auth_token' => '{{auth_token}}',
                    'id' => '{{related_user_id}}',
                ]];
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
            'flipper' => ['not_null'],

            'flipper_id' => ['integer'],

            'related_user_id' => ['required', 'integer'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListService::class,
        ];
    }
}
