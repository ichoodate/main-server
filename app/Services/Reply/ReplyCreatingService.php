<?php

namespace App\Services\Reply;

use App\Models\Reply;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Ticket\TicketFindingService;
use FunctionalCoding\Service;

class ReplyCreatingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbacks()
    {
        return [];
    }

    public static function getArrLoaders()
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

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'description' => ['required', 'string'],

            'ticket_id' => ['required', 'integer'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
