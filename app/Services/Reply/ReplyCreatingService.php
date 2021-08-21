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

    public static function getArrCallbackLists()
    {
        return [];
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

            'created' => function ($authUser, $description, $ticket) {
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
