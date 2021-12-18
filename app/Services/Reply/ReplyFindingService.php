<?php

namespace App\Services\Reply;

use App\Models\Reply;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class ReplyFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'reply for {{id}}',
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
                return [];
            },

            'model_class' => function () {
                return Reply::class;
            },

            'permitted_user' => function ($adminRole, $authUser, $model) {
                if (!empty($adminRole) || $authUser->getKey() == $model->{Reply::WRITER_ID} || ($model->ticket && $model->ticket->{Ticket::WRITER_ID})) {
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
