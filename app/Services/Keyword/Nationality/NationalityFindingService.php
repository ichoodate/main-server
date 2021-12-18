<?php

namespace App\Services\Keyword\Nationality;

use App\Models\Keyword\Nationality;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class NationalityFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'nationality keyword for {{id}}',
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
                return ['country'];
            },

            'model_class' => function () {
                return Nationality::class;
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
