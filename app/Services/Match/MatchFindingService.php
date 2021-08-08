<?php

namespace App\Services\Match;

use App\Database\Models\Match;
use Illuminate\Extend\Service;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;

class MatchFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'match for {{id}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {

                return ['cards', 'friends', 'man', 'woman'];
            },

            'model_class' => function () {

                return Match::class;
            },

            'permitted_user' => function ($authUser, $model) {

                if ( in_array($authUser->getKey(), [$model->{Match::MAN_ID}, $model->{Match::WOMAN_ID}]) )
                {
                    return $authUser;
                }
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
        return [
            FindingService::class,
            PermittedUserRequiringService::class,
        ];
    }

}
