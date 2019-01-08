<?php

namespace App\Services\Ticket;

use App\Database\Models\Ticket;
use App\Services\AuthUserRequiringService;
use App\Service;

class TicketPagingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => ['query', 'auth_user', function ($query, $authUser) {

                $query->qWhere(Ticket::WRITER_ID, $authUser->getKey());
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return Ticket::class;
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [];
    }

    public static function getArrTraits()
    {
        return [
            AuthUserRequiringService::class
        ];
    }

}
