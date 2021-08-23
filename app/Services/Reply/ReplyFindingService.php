<?php

namespace App\Services\Reply;

use App\Models\Reply;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class ReplyFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'reply for {{id}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
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
            FindService::class,
            PermittedUserRequiringService::class,
        ];
    }
}
