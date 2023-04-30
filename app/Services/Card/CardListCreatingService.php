<?php

namespace App\Services\Card;

use App\Models\Card;
use App\Services\Matching\MatchingCreatingService;
use FunctionalCoding\Service;

class CardListCreatingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'auth_user' => function () {
                throw new \Exception();
            },

            'card_group' => function () {
                throw new \Exception();
            },

            'matches' => function ($authUser, $users) {
                return [MatchingCreatingService::class, [
                    'auth_user' => $authUser,
                    'matching_users' => $users,
                ]];
            },

            'result' => function ($authUser, $cardGroup, $matches, $users) {
                $cards = (new Card())->newCollection();

                foreach ($matches as $i => $match) {
                    $card = (new Card())->create([
                        Card::GROUP_ID => $cardGroup->getKey(),
                        Card::MATCH_ID => $matches[$i]->getKey(),
                        Card::CHOOSER_ID => $authUser->getKey(),
                        Card::SHOWNER_ID => $users[$i]->getKey(),
                    ]);

                    $cards->push($card);
                }

                return $cards;
            },

            'users' => function () {
                throw new \Exception();
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
        return [];
    }
}
