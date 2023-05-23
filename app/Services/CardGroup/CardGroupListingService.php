<?php

namespace App\Services\CardGroup;

use App\Models\CardGroup;
use FunctionalCoding\ORM\Eloquent\Service\PaginationListService;
use FunctionalCoding\Service;

class CardGroupListingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'query.after' => function ($after, $query, $timezone) {
                $time = new \DateTime($after, new \DateTimeZone($timezone));
                $time->setTimezone(new \DateTimeZone('UTC'));

                $query->where(CardGroup::CREATED_AT, '>=', $time->format('Y-m-d H:i:s'));
            },

            'query.auth_user' => function ($authUser, $query) {
                $query->where(CardGroup::USER_ID, $authUser->getKey());
            },

            'query.before' => function ($before, $query, $timezone) {
                $time = new \DateTime($before, new \DateTimeZone($timezone));
                $time->setTimezone(new \DateTimeZone('UTC'));

                $query->where(CardGroup::CREATED_AT, '<=', $time->format('Y-m-d H:i:s'));
            },
        ];
    }

    public static function getLoaders()
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

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'after' => ['string', 'date_format:Y-m-d H:i:s'],

            'auth_user' => ['required'],

            'before' => ['string', 'date_format:Y-m-d H:i:s'],

            'timezone' => ['required_with:after', 'required_with:before', 'string', 'timezone'],
        ];
    }

    public static function getTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
