<?php

namespace App\Services\Keyword\Residence;

use App\Database\Models\Keyword\Residence;
use Illuminate\Extend\Service;
use App\Services\ListingService;

class ResidenceListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.parent_id' => function ($parentId, $query) {

                $query->qWhere('parent_id', $parentId);
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {

                return ['related', 'related.concrete'];
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
            ListingService::class,
        ];
    }

}
