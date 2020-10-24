<?php

namespace App\Services\Reply;

use App\Database\Models\Reply;
use App\Service;
use App\Services\LimitedListingService;
use App\Services\Ticket\TicketFindingService;
use App\Services\Reply\ReplyFindingService;

class TicketReplyListingService extends Service {

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
            'cursor' => ['auth_user', 'cursor_id', function ($authUser, $cursorId) {

                return [ReplyFindingService::class, [
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
            'auth_user'
                => ['required'],

            'ticket'
                => ['not_null'],

            'ticket_id'
                => ['required', 'integer']
        ];
    }

    public static function getArrTraits()
    {
        return [
            LimitedListingService::class
        ];
    }

}
