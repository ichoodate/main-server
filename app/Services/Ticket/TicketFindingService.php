<?php

namespace App\Services\Ticket;

use App\Models\Ticket;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class TicketFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'ticket for {{id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'available_expands' => function () {
                return ['replies', 'writer'];
            },

            'model_class' => function () {
                return Ticket::class;
            },

            'permitted_user' => function ($adminRole, $authUser, $model) {
                if (!empty($adminRole) || in_array($authUser->getKey(), [$model->{Ticket::WRITER_ID}])) {
                    return $authUser;
                }
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [];
    }

    public static function getTraits()
    {
        return [
            FindService::class,
            PermittedUserRequiringService::class,
        ];
    }
}
