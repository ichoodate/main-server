<?php

namespace App\Services\Reply;

use App\Database\Models\Reply;
use App\Services\AuthUserRequiringService;
use App\Services\PagingService;
use App\Service;
use App\Services\Ticket\TicketFindingService;

class TicketReplyPagingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'ticket'
                => 'ticket for {{ticket_id}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.ticket' => ['query', 'ticket', function ($query, $ticket) {

                $query->qWhere(Reply::TICKET_ID, $ticket->getKey());
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return Reply::class;
            }],

            'ticket' => ['auth_user', 'ticket_id', function ($authUser, $ticketId) {

                return [TicketFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $ticketId
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => '{{ticket_id}}'
                ]];
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
            'ticket'
                => ['not_null'],

            'ticket_id'
                => ['required', 'integer']
        ];
    }

    public static function getArrTraits()
    {
        return [
            AuthUserRequiringService::class,
            PagingService::class
        ];
    }

}
