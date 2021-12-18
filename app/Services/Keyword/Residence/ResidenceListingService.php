<?php

namespace App\Services\Keyword\Residence;

use App\Models\Keyword\Residence;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class ResidenceListingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'query.parent_id' => function ($parentId, $query) {
                $query->where('parent_id', $parentId);
            },
        ];
    }

    public static function getLoaders()
    {
        return [
            'available_expands' => function () {
                return ['related', 'relatedObj.concrete'];
            },

            'model_class' => function () {
                return Residence::class;
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
            ListService::class,
        ];
    }
}
