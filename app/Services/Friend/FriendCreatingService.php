<?php

namespace App\Services\Friend;

use App\Database\Models\Friend;
use Illuminate\Extend\Service;
use App\Services\Match\MatchFindingService;

class FriendCreatingService extends Service {

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
            'created' => function ($authUser, $match, $user) {

                return Friend::create([
                    Friend::SENDER_ID   => $authUser->getKey(),
                    Friend::RECEIVER_ID => $user->getKey(),
                    Friend::MATCH_ID    => $match->getKey(),
                ]);
            },

            'match' => function ($authUser, $matchId) {

                return [MatchFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $matchId,
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => '{{match_id}}',
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
            'auth_user'
                => ['required'],

            'match_id'
                => ['required']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
