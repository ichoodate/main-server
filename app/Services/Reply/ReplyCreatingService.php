<?php

namespace App\Services\Reply;

use App\Models\Reply;
use App\Services\Auth\AuthUserFindingService;
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
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'auth_token' => $authToken,
                ], [
                    'auth_token' => '{{auth_token}}',
                ]];
            },

            'result' => function ($authUser, $description, $ticket) {
                return (new Reply())->create([
                    Reply::WRITER_ID => $authUser->getKey(),
                    Reply::DESCRIPTION => $description,
                    Reply::TICKET_ID => $ticket->getKey(),
                ]);
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
            'description' => ['required', 'string'],

            'ticket_id' => ['required', 'integer'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
