<?php

namespace App\Services\CardFlip;

use FunctionalCoding\Service;

class FreeCardFlipCreatingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbacks()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'free_flippable_card' => ['not_null'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            CardFlipCreatingService::class,
        ];
    }
}
