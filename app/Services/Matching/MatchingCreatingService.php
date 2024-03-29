<?php

namespace App\Services\Matching;

use App\Models\Matching;
use App\Models\User;
use FunctionalCoding\Service;

class MatchingCreatingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'auth_user_id_field' => function ($authUser) {
                if (User::GENDER_MAN == $authUser->{User::GENDER}) {
                    return Matching::MAN_ID;
                }

                return Matching::WOMAN_ID;
            },

            'created' => function ($authUser, $authUserIdField, $matchingUserIdField, $newMatchingUserIds) {
                $matches = (new Matching())->newCollection();

                foreach ($newMatchingUserIds as $userId) {
                    $match = (new Matching())->create([
                        $authUserIdField => $authUser->getKey(),
                        $matchingUserIdField => $userId,
                    ]);

                    $matches->push($match);
                }

                return $matches;
            },

            'existed' => function ($authUser, $authUserIdField, $matchingUserIdField, $matchingUserIds) {
                return Matching::query()
                    ->where($authUserIdField, $authUser->getKey())
                    ->whereIn($matchingUserIdField, $matchingUserIds)
                    ->get()
                ;
            },

            'existed_matching_user_ids' => function ($existed, $matchingUserIdField) {
                return $existed->pluck($matchingUserIdField)->all();
            },

            'matching_user_id_field' => function ($authUser) {
                if (User::GENDER_MAN == $authUser->{User::GENDER}) {
                    return Matching::WOMAN_ID;
                }

                return Matching::MAN_ID;
            },

            'matching_user_ids' => function ($matchingUsers) {
                return $matchingUsers->modelKeys();
            },

            'matching_users' => function () {
                throw new \Exception();
            },

            'new_matching_user_ids' => function ($existedMatchingUserIds, $matchingUserIds) {
                return array_values(array_diff($matchingUserIds, $existedMatchingUserIds));
            },

            'result' => function ($created, $existed) {
                return $created->merge($existed);
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
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
