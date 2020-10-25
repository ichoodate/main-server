<?php

namespace App\Services\Notice;

use App\Database\Models\Notice;
use Illuminate\Extend\Service;
use App\Services\LimitedListingService;

class NoticeListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.type' => ['query', 'type', function ($query, $type) {

                $query->qWhere(Notice::TYPE, $type);
            }]
        ];
    }
    public static function getArrLoaders()
    {
        return [
            'cursor' => ['cursor_id', function ($cursorId) {

                return [NoticeFindingService::class, [
                    'id'
                        => $cursorId
                ], [
                    'id'
                        => '{{cursor_id}}'
                ]];
            }],

            'model_class' => [function () {

                return Notice::class;
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'type'
                => ['in:' . implode(',', Notice::TYPE_VALUES)]
        ];
    }

    public static function getArrTraits()
    {
        return [
            LimitedListingService::class
        ];
    }

}
