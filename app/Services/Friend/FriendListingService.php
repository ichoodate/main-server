<?php

namespace App\Services\Friend;

use App\Models\Friend;
use App\Models\Matching;
use App\Models\User;
use App\Services\Auth\AuthUserFindingService;
use App\Services\User\MatchingUserFindingService;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class FriendListingService extends Service
{
    public static function getBindNames()
    {
        return [
            'sender' => 'user for {{sender_id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [
            'query.match' => function ($authUser, $query, $relatedUser) {
                $subQuery1 = Matching::query()
                    ->select(Matching::ID)
                    ->where(User::GENDER_MAN == $relatedUser->{User::GENDER} ? Matching::MAN_ID : Matching::WOMAN_ID, $relatedUser->getKey())
                    ->where(User::GENDER_MAN == $authUser->{User::GENDER} ? Matching::MAN_ID : Matching::WOMAN_ID, $authUser->getKey())
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

    public static function getLoaders()
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

            'sender' => function ($senderId) {
                return User::find($senderId);
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
            'related_user_id' => ['required', 'integer'],

            'sender' => ['not_null'],

            'sender_id' => ['integer'],
        ];
    }

    public static function getTraits()
    {
        return [
            ListService::class,
        ];
    }
}
