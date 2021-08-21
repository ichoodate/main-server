<?php

namespace App\Services\Ticket;

use App\Models\Ticket;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\Service;

class TicketCreatingService extends Service
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

            'created' => function ($authUser, $description, $subject) {
                return (new Ticket())->create([
                    Ticket::WRITER_ID => $authUser->getKey(),
                    Ticket::SUBJECT => $subject,
                    Ticket::DESCRIPTION => $description,
                ]);
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

            'subject' => ['required', 'string'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
