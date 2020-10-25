<?php

namespace App\Services\Ticket;

use App\Database\Models\Ticket;
use Illuminate\Extend\Service;
use App\Services\CreatingService;

class TicketCreatingService extends Service {

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
            'created' => ['auth_user', 'subject', 'description', function ($authUser, $subject, $description) {

                return (new Ticket)->create([
                    Ticket::WRITER_ID   => $authUser->getKey(),
                    Ticket::SUBJECT     => $subject,
                    Ticket::DESCRIPTION => $description
                ]);
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

            'subject'
                => ['required', 'string']
        ];
    }

    public static function getArrTraits()
    {
        return [
            CreatingService::class
        ];
    }

}
