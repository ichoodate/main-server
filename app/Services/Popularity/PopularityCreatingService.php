<?php

namespace App\Services\Popularity;

use App\Models\Popularity;
use App\Services\User\MatchingUserFindingService;
use FunctionalCoding\Service;

class PopularityCreatingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'user' => function ($authUser, $user) {
                Popularity::query()
                    ->where(Popularity::SENDER_ID, $authUser->getKey())
                    ->where(Popularity::RECEIVER_ID, $user->getKey())
                    ->delete()
                ;
            },
        ];
    }

    public static function getLoaders()
    {
        return [
            'created' => function ($authUser, $point, $user) {
                return (new Popularity())->create([
                    Popularity::SENDER_ID => $authUser->getKey(),
                    Popularity::RECEIVER_ID => $user->getKey(),
                    Popularity::POINT => $point,
                ]);
            },

            'user' => function ($authUser, $userId) {
                return [MatchingUserFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $userId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{user_id}}',
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

            'point' => ['required', 'integer', 'min:1', 'max:10'],

            'user_id' => ['required'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
