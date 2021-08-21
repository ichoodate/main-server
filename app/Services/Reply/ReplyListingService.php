<?php

namespace App\Services\Reply;

use App\Models\Reply;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Ticket\TicketFindingService;
use FunctionalCoding\ORM\Eloquent\Service\PaginationListService;
use FunctionalCoding\Service;

class ReplyListingService extends Service
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
                $query->where(Reply::TICKET_ID, $ticket->getKey());
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'token' => $authToken,
                ], [
                    'token' => '{{auth_token}}',
                ]];
            },

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
