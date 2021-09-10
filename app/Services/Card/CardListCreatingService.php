<?php

namespace App\Services\Card;

use App\Models\Card;
use App\Services\Match\MatchCreatingService;
use FunctionalCoding\Service;

class CardListCreatingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbacks()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'auth_user' => function () {
                throw new \Exception();
            },

            'card_group' => function () {
                throw new \Exception();
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

            'matches' => function ($authUser, $users) {
                return [MatchCreatingService::class, [
                    'auth_user' => $authUser,
                    'matching_users' => $users,
                ]];
            },

            'users' => function () {
                throw new \Exception();
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
        return [];
    }
}
