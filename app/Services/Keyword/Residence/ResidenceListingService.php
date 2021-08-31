<?php

namespace App\Services\Keyword\Residence;

use App\Models\Keyword\Residence;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class ResidenceListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbacks()
    {
        return [
            'query.parent_id' => function ($parentId, $query) {
                $query->where('parent_id', $parentId);
            },
        ];
    }

    public static function getArrLoaders()
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
            ListService::class,
        ];
    }
}
