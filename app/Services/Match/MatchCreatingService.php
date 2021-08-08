<?php

namespace App\Services\Match;

use App\Database\Models\Match;
use App\Database\Models\User;
use Illuminate\Extend\Service;

class MatchCreatingService extends Service {

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
            'auth_user_id_field' => function ($authUser) {

                if ( $authUser->{User::GENDER} == User::GENDER_MAN )
                {
                    return Match::MAN_ID;
                }
                else
                {
                    return Match::WOMAN_ID;
                }
            },

            'created' => function ($authUser, $authUserIdField, $matchingUserIdField, $newMatchingUserIds) {

                $matches = (new Match)->newCollection();

                foreach ( $newMatchingUserIds as $userId )
                {
                    $match = (new Match)->create([
                        $authUserIdField     => $authUser->getKey(),
                        $matchingUserIdField => $userId
                    ]);

                    $matches->push($match);
                }

                return $matches;
            },

            'existed' => function ($authUser, $authUserIdField, $matchingUserIdField, $matchingUserIds) {

                return (new Match)->query()
                    ->qWhere($authUserIdField, $authUser->getKey())
                    ->qWhereIn($matchingUserIdField, $matchingUserIds)
                    ->get();
            },

            'existed_matching_user_ids' => function ($existed, $matchingUserIdField) {

                return $existed->pluck($matchingUserIdField)->all();
            },

            'matching_user_id_field' => function ($authUser) {

                if ( $authUser->{User::GENDER} == User::GENDER_MAN )
                {
                    return Match::WOMAN_ID;
                }
                else
                {
                    return Match::MAN_ID;
                }
            },

            'matching_user_ids' => function ($matchingUsers) {

                return $matchingUsers->modelKeys();
            },

            'matching_users' => function () {

                throw new \Exception;
            },

            'new_matching_user_ids' => function ($existedMatchingUserIds, $matchingUserIds) {

                return array_values(array_diff($matchingUserIds, $existedMatchingUserIds));
            },

            'result' => function ($created, $existed) {

                return $created->merge($existed);
            },
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
