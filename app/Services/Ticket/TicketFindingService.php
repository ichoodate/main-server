<?php

namespace App\Services\Ticket;

use App\Database\Models\Ticket;
use Illuminate\Extend\Service;
use App\Services\AdminRoleExistingService;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;

class TicketFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'ticket for {{id}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => [function () {

                return ['replies', 'writer'];
            }],

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
            AdminRoleExistingService::class,
            FindingService::class,
            PermittedUserRequiringService::class
        ];
    }

}
