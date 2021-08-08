<?php

namespace App\Services\User;

use App\Database\Models\User;
use Illuminate\Extend\Service;
use App\Services\FindingService;

class UserFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'user for {{id}}',
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

                return ['facePhoto', 'friend', 'match', 'match.cards.flips', 'popularity'];
            },

            'model_class' => function () {

                return User::class;
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
        ];
    }

}
