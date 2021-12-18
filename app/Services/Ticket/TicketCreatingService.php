<?php

namespace App\Services\Ticket;

use App\Models\Ticket;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\Service;

class TicketCreatingService extends Service
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

            'created' => function ($authUser, $description, $subject) {
                return (new Ticket())->create([
                    Ticket::WRITER_ID => $authUser->getKey(),
                    Ticket::SUBJECT => $subject,
                    Ticket::DESCRIPTION => $description,
                ]);
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

            'subject' => ['required', 'string'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
