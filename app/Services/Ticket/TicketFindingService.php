<?php

namespace App\Services\Ticket;

use App\Database\Models\Ticket;
use App\Services\PermittedUserRequiringService;
use App\Service;

class TicketFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'ticket of {{id}}'
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

                return Ticket::class;
            }],

            'permitted_user' => ['admin_role', 'auth_user', 'model', function ($adminRole, $authUser, $model) {

                if ( ! empty($adminRole) || $authUser->getKey() == $model->{Ticket::WRITER_ID} )
                {
                    return $authUser;
                }
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
            AdminUserRequiringService::class,
            PermittedUserRequiringService::class,
            FindingService::class
        ];
    }

}
