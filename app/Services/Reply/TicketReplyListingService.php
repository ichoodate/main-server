<?php

namespace App\Services\Reply;

use App\Models\Reply;
use App\Services\Ticket\TicketFindingService;
use FunctionalCoding\ORM\Eloquent\Service\PaginationListService;
use FunctionalCoding\Service;

class TicketReplyListingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'ticket' => 'ticket for {{ticket_id}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.ticket' => function ($query, $ticket) {
                $query->qWhere(Reply::TICKET_ID, $ticket->getKey());
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {
                return ['ticket', 'writer'];
            },

            'cursor' => function ($authUser, $cursorId) {
                return [ReplyFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $cursorId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{cursor_id}}',
                ]];
            },

            'model_class' => function () {
                return Reply::class;
            },

            'ticket' => function ($authUser, $ticketId) {
                return [TicketFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $ticketId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{ticket_id}}',
                ]];
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

            'ticket' => ['not_null'],

            'ticket_id' => ['required', 'integer'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
