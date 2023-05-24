<?php

namespace App\Services\Friend;

use App\Models\Friend;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class FriendFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'friend for {{id}}',
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
                return ['match', 'receiver', 'sender'];
            },

            'model_class' => function () {
                return Friend::class;
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
        return [
            FindService::class,
        ];
    }
}
