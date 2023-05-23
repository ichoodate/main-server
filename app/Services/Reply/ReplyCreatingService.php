<?php

namespace App\Services\Reply;

use App\Models\Reply;
use App\Services\Ticket\TicketFindingService;
use FunctionalCoding\Service;

class ReplyCreatingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'result' => function ($authUser, $description, $ticket) {
                return (new Reply())->create([
                    Reply::WRITER_ID => $authUser->getKey(),
                    Reply::DESCRIPTION => $description,
                    Reply::TICKET_ID => $ticket->getKey(),
                ]);
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

            'description' => ['required', 'string'],

            'ticket_id' => ['required', 'integer'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
