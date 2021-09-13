<?php

namespace App\Services\Friend;

use App\Models\Friend;
use App\Models\Match;
use App\Models\User;
use App\Services\Auth\AuthUserFindingService;
use App\Services\User\MatchingUserFindingService;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class FriendListingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'sender' => 'user for {{sender_id}}',
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

                $query
                    ->whereIn(Friend::MATCH_ID, $subQuery1)
                ;
            },

            'query.sender' => function ($query, $sender) {
                $query->where(Friend::SENDER_ID, $sender->getKey());
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

            'sender' => function ($senderId) {
                return User::find($senderId);
            },

            'model_class' => function () {
                return Friend::class;
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
            'sender' => ['not_null'],

            'sender_id' => ['integer'],

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
