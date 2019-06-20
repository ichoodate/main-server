<?php

namespace App\Services\Reply;

use App\Database\Models\Ticket;
use App\Database\Models\Reply;
use App\Service;
use App\Services\CreatingService;
use App\Services\Ticket\TicketFindingService;

class TicketReplyCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'created' => ['auth_user', 'ticket', 'description', function ($authUser, $ticket, $description) {

                return inst(Reply::class)->create([
                    Reply::WRITER_ID   => $authUser->getKey(),
                    Reply::DESCRIPTION => $description,
                    Reply::TICKET_ID   => $ticket->getKey()
                ]);
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

            'description'
                => ['required', 'string'],

            'ticket_id'
                => ['required', 'integer']
        ];
    }

    public static function getArrTraits()
    {
        return [
            CreatingService::class
        ];
    }

}
