<?php

namespace App\Services\Keyword\Career;

use App\Models\Keyword\Career;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class CareerListingService extends Service
{
    public static function getBindNames()
    {
        return [
            'parent' => 'career for {{parent_id}}',
        ];
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
                return [];
            },

            'model_class' => function () {
                return Career::class;
            },

            'parent' => function ($parentId) {
                return Career::find($parentId);
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'parent_id' => ['present', 'integer', 'nullable'],

            'parent' => ['required_unless:parent_id,null'],
        ];
    }

    public static function getTraits()
    {
        return [
            ListService::class,
        ];
    }
}
