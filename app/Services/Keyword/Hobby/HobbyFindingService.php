<?php

namespace App\Services\Keyword\Hobby;

use App\Models\Keyword\Hobby;
use App\Services\FindingService;
use FunctionalCoding\Service;

class HobbyFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'hobby keyword for {{id}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => function () {
                return Hobby::class;
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
