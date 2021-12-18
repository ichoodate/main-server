<?php

namespace App\Services\Keyword\State;

use App\Models\Keyword\State;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class StateFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'state keyword for {{id}}',
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
                return ['country', 'residence'];
            },

            'model_class' => function () {
                return State::class;
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
