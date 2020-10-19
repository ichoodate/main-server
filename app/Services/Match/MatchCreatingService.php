<?php

namespace App\Services\Match;

use App\Database\Models\Match;
use App\Database\Models\User;
use App\Service;

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
            'auth_user_id_field' => ['auth_user', function ($authUser) {

                if ( $authUser->{User::GENDER} == User::GENDER_MAN )
                {
                    return Match::MAN_ID;
                }
                else
                {
                    return Match::WOMAN_ID;
                }
            }],

            'created' => ['auth_user', 'auth_user_id_field', 'new_matching_user_ids', 'matching_user_id_field', function ($authUser, $authUserIdField, $newMatchingUserIds, $matchingUserIdField) {

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
            }],

            'existed' => ['auth_user', 'auth_user_id_field', 'matching_user_id_field', 'matching_user_ids', function ($authUser, $authUserIdField, $matchingUserIdField, $matchingUserIds) {

                return (new Match)->query()
                    ->qWhere($authUserIdField, $authUser->getKey())
                    ->qWhereIn($matchingUserIdField, $matchingUserIds)
                    ->get();
            }],

            'existed_matching_user_ids' => ['existed', 'matching_user_id_field', function ($existed, $matchingUserIdField) {

                return $existed->pluck($matchingUserIdField)->all();
            }],

            'matching_user_id_field' => ['auth_user', function ($authUser) {

                if ( $authUser->{User::GENDER} == User::GENDER_MAN )
                {
                    return Match::WOMAN_ID;
                }
                else
                {
                    return Match::MAN_ID;
                }
            }],

            'matching_users' => [function () {

                throw new \Exception;
            }],

            'matching_user_ids' => ['matching_users', function ($matchingUsers) {

                return $matchingUsers->modelKeys();
            }],

            'new_matching_user_ids' => ['matching_user_ids', 'existed_matching_user_ids', function ($matchingUserIds, $existedMatchingUserIds) {

                return array_values(array_diff($matchingUserIds, $existedMatchingUserIds));
            }],

            'result' => ['created', 'existed', function ($created, $existed) {

                return $created->merge($existed);
            }]
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
