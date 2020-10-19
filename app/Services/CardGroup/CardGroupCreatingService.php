<?php

namespace App\Services\CardGroup;

use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Service;
use App\Services\CreatingService;
use App\Services\Match\MatchCreatingService;

class CardGroupCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'cards' => ['auth_user', 'matches', 'users', 'created', function ($authUser, $matches, $users, $created) {

                $cards = (new Card)->newCollection();

                foreach ( $matches as $i => $match )
                {
                    $card = (new Card)->create([
                        Card::GROUP_ID   => $created->getKey(),
                        Card::MATCH_ID   => $matches[$i]->getKey(),
                        Card::CHOOSER_ID => $authUser->getKey(),
                        Card::SHOWNER_ID => $users[$i]->getKey()
                    ]);

                    $cards->push($card);
                }

                return $cards;
            }],

            'created' => [function () {

                throw new \Exception;
            }],

            'matches' => ['auth_user', 'users', function ($authUser, $users) {

                return [MatchCreatingService::class, [
                    'auth_user'
                        => $authUser,
                    'matching_users'
                        => $users,
                ]];
            }],

            'users' => [function () {

                throw new \Exception;
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
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
            CreatingService::class
        ];
    }

}
