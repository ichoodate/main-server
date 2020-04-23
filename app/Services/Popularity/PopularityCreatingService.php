<?php

namespace App\Services\Popularity;

use App\Database\Models\Popularity;
use App\Service;
use App\Services\User\MatchingUserFindingService;
use App\Services\CreatingService;

class PopularityCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'user' => ['auth_user', 'user', function ($authUser, $user) {

                Popularity::query()
                    ->where(Popularity::SENDER_ID, $authUser->getKey())
                    ->where(Popularity::RECEIVER_ID, $user->getKey())
                    ->delete();
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'user' => ['auth_user', 'user_id', function ($authUser, $userId) {

                return [MatchingUserFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $userId,
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => '{{user_id}}',
                ]];
            }],

            'created' => ['auth_user', 'user', 'point', function ($authUser, $user, $point) {

                return Popularity::create([
                    Popularity::SENDER_ID   => $authUser->getKey(),
                    Popularity::RECEIVER_ID => $user->getKey(),
                    Popularity::POINT       => $point
                ]);
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
            'auth_user'
                => ['required'],

            'user_id'
                => ['required'],

            'point'
                => ['required', 'integer', 'min:1', 'max:10']
        ];
    }

    public static function getArrTraits()
    {
        return [
            CreatingService::class
        ];
    }

}
