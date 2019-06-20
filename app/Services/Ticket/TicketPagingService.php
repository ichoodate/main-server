<?php

namespace App\Services\Ticket;

use App\Database\Models\Ticket;
use App\Service;
use App\Services\PagingService;
use App\Services\Ticket\TicketFindingService;

class TicketPagingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => ['query', 'auth_user', function ($query, $authUser) {

                $query->qWhere(Ticket::WRITER_ID, $authUser->getKey());
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'cursor' => ['auth_user', 'cursor_id', function ($authUser, $cursorId) {

                return [TicketFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $cursorId
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => '{{cursor_id}}'
                ]];
            }],

            'model_class' => [function () {

                return Ticket::class;
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
            'auth_user'
                => ['required']
        ];
    }

    public static function getArrTraits()
    {
        return [
            PagingService::class
        ];
    }

}
