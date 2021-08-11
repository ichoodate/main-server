<?php

namespace App\Services\Keyword\Body;

use App\Models\Keyword\Body;
use FunctionalCoding\Illuminate\Service\FindService;
use FunctionalCoding\Service;

class BodyFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'body keyword for {{id}}',
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
                return Body::class;
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
