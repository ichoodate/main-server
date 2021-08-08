<?php

namespace App\Services\Popularity;

use App\Database\Models\Popularity;
use Illuminate\Extend\Service;
use App\Services\User\MatchingUserFindingService;

class PopularityCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'user' => function ($authUser, $user) {

                Popularity::query()
                    ->where(Popularity::SENDER_ID, $authUser->getKey())
                    ->where(Popularity::RECEIVER_ID, $user->getKey())
                    ->delete();
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'created' => function ($authUser, $point, $user) {

                return Popularity::create([
                    Popularity::SENDER_ID   => $authUser->getKey(),
                    Popularity::RECEIVER_ID => $user->getKey(),
                    Popularity::POINT       => $point
                ]);
            },

            'user' => function ($authUser, $userId) {

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

            'user_id'
                => ['required'],

            'point'
                => ['required', 'integer', 'min:1', 'max:10']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
