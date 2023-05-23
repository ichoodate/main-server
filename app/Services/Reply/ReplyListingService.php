<?php

namespace App\Services\Reply;

use App\Models\Reply;
use App\Services\Ticket\TicketFindingService;
use FunctionalCoding\ORM\Eloquent\Service\PaginationListService;
use FunctionalCoding\Service;

class ReplyListingService extends Service
{
    public static function getBindNames()
    {
        return [
            'ticket' => 'ticket for {{ticket_id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [
            'query.ticket' => function ($query, $ticket) {
                $query->where(Reply::TICKET_ID, $ticket->getKey());
            },
        ];
    }

    public static function getLoaders()
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

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'auth_user' => ['required'],

            'ticket' => ['not_null'],

            'ticket_id' => ['required', 'integer'],
        ];
    }

    public static function getTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
