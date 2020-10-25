<?php

namespace App\Services\Reply;

use App\Database\Models\Reply;
use App\Database\Models\Ticket;
use Illuminate\Extend\Service;
use App\Services\FindingService;
use App\Services\Ticket\TicketFindingService;

class ReplyFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'reply for {{id}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return Reply::class;
            }],

            'ticket' => ['auth_user', 'model', function ($authUser, $model) {

                return [TicketFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $model->{Reply::TICKET_ID}
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => 'ticket_id of {{model}}'
                ]];
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [
            'result'
                => ['ticket']
        ];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user'
                => ['required']
        ];
    }

    public static function getArrTraits()
    {
        return [
            FindingService::class
        ];
    }

}
