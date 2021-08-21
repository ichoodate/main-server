<?php

namespace App\Services\Friend;

use App\Models\Friend;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Match\MatchFindingService;
use FunctionalCoding\Service;

class FriendCreatingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'token' => $authToken,
                ], [
                    'token' => '{{auth_token}}',
                ]];
            },

            'created' => function ($authUser, $match, $user) {
                return Friend::create([
                    Friend::SENDER_ID => $authUser->getKey(),
                    Friend::RECEIVER_ID => $user->getKey(),
                    Friend::MATCH_ID => $match->getKey(),
                ]);
            },

            'match' => function ($authUser, $matchId) {
                return [MatchFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $matchId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{match_id}}',
                ]];
            },

            'user' => function ($match) {
                return $match->user;
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
            'match_id' => ['required'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
