<?php

namespace App\Services\User;

use App\Models\User;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class UserFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'user for {{id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'available_expands' => function () {
                return ['facePhoto', 'friend', 'match', 'match.friends', 'match.cards.flips', 'popularity'];
            },

            'model_class' => function () {
                return User::class;
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [];
    }

    public static function getTraits()
    {
        return [
            FindService::class,
        ];
    }
}
