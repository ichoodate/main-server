<?php

namespace App\Services\Friend;

use App\Models\Friend;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class FriendFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'friend for {{id}}',
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
                return ['match', 'receiver', 'sender'];
            },

            'model_class' => function () {
                return Friend::class;
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
            FindService::class,
        ];
    }
}
