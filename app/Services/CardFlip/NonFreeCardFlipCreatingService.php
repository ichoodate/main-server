<?php

namespace App\Services\CardFlip;

use FunctionalCoding\Service;

class NonFreeCardFlipCreatingService extends Service
{
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
        return [];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'free_flippable_card' => ['null'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            CardFlipCreatingService::class,
        ];
    }
}
