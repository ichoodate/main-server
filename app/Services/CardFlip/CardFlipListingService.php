<?php

namespace App\Services\CardFlip;

use App\Models\Card;
use App\Models\CardFlip;
use App\Models\Matching;
use App\Models\User;
use App\Services\User\MatchingUserFindingService;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class CardFlipListingService extends Service
{
    public static function getBindNames()
    {
        return [
            'flipper' => 'user for {{flipper_id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [
            'query.flipper' => function ($flipper, $query) {
                $query->where(CardFlip::USER_ID, $flipper->getKey());
            },

            'query.match' => function ($authUser, $query, $relatedUser) {
                $subQuery1 = Matching::query()
                    ->select(Matching::ID)
                    ->where(User::GENDER_MAN == $relatedUser->{User::GENDER} ? Matching::MAN_ID : Matching::WOMAN_ID, $relatedUser->getKey())
                    ->where(User::GENDER_MAN == $authUser->{User::GENDER} ? Matching::MAN_ID : Matching::WOMAN_ID, $authUser->getKey())
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
        ];
    }

    public static function getLoaders()
    {
        return [
            'available_expands' => function () {
                return [];
            },

            'flipper' => function ($flipperId) {
                return User::find($flipperId);
            },

            'model_class' => function () {
                return CardFlip::class;
            },

            'related_user' => function ($authUser, $relatedUserId) {
                return [MatchingUserFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $relatedUserId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{related_user_id}}',
                ]];
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

            'flipper' => ['not_null'],

            'flipper_id' => ['integer'],

            'related_user_id' => ['required', 'integer'],
        ];
    }

    public static function getTraits()
    {
        return [
            ListService::class,
        ];
    }
}
