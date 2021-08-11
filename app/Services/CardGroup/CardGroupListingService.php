<?php

namespace App\Services\CardGroup;

use App\Models\CardGroup;
use FunctionalCoding\Illuminate\Service\PaginationListService;
use FunctionalCoding\Service;

class CardGroupListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => function ($authUser, $query) {
                $query->qWhere(CardGroup::USER_ID, $authUser->getKey());
            },

            'query.timezone' => function ($after, $query, $timezone) {
                $time = new \DateTime($after, new \DateTimeZone($timezone));
                $time->setTimezone(new \DateTimeZone('UTC'));

                $query->qWhere(CardGroup::CREATED_AT, '>=', $time->format('Y-m-d H:i:s'));
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {
                return ['cards.flips', 'cards.chooser.facePhoto', 'cards.chooser.popularity', 'cards.showner.facePhoto', 'cards.showner.popularity', 'user'];
            },

            'cursor' => function ($authUser, $cursorId) {
                return [CardGroupFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $cursorId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{cursor_id}}',
                ]];
            },

            'model_class' => function () {
                return CardGroup::class;
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
            'after' => ['required', 'date_format:Y-m-d H:i:s'],

            'auth_user' => ['required'],

            'timezone' => ['required', 'timezone'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
