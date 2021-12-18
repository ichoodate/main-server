<?php

namespace App\Services\Reply;

use App\Models\Reply;
use App\Services\Auth\AuthUserFindingService;
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
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'auth_token' => $authToken,
                ], [
                    'auth_token' => '{{auth_token}}',
                ]];
            },

            'available_expands' => function () {
                return ['ticket', 'writer'];
            },

            'cursor' => function ($authToken, $cursorId) {
                return [ReplyFindingService::class, [
                    'auth_token' => $authToken,
                    'id' => $cursorId,
                ], [
                    'auth_token' => '{{auth_token}}',
                    'id' => '{{cursor_id}}',
                ]];
            },

            'model_class' => function () {
                return Reply::class;
            },

            'ticket' => function ($authToken, $ticketId) {
                return [TicketFindingService::class, [
                    'auth_token' => $authToken,
                    'id' => $ticketId,
                ], [
                    'auth_token' => '{{auth_token}}',
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
