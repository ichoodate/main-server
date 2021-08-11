<?php

namespace App\Services\Ticket;

use App\Models\Ticket;
use App\Services\LimitedListingService;
use FunctionalCoding\Service;

class TicketListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => function ($authUser, $query) {
                $query->qWhere(Ticket::WRITER_ID, $authUser->getKey());
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {
                return ['replies', 'writer'];
            },

            'cursor' => function ($authUser, $cursorId) {
                return [TicketFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $cursorId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{cursor_id}}',
                ]];
            },

            'model_class' => function () {
                return Ticket::class;
            },
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user' => ['required'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            LimitedListingService::class,
        ];
    }
}
