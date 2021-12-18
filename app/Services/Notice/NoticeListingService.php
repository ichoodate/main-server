<?php

namespace App\Services\Notice;

use App\Models\Notice;
use FunctionalCoding\ORM\Eloquent\Service\PaginationListService;
use FunctionalCoding\Service;

class NoticeListingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'query.type' => function ($query, $type) {
                $query->where(Notice::TYPE, $type);
            },
        ];
    }

    public static function getLoaders()
    {
        return [
            'available_expands' => function () {
                return [];
            },

            'cursor' => function ($cursorId) {
                return [NoticeFindingService::class, [
                    'id' => $cursorId,
                ], [
                    'id' => '{{cursor_id}}',
                ]];
            },

            'model_class' => function () {
                return Notice::class;
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
            'type' => ['in:'.implode(',', Notice::TYPE_VALUES)],
        ];
    }

    public static function getTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
