<?php

namespace App\Services\Card;

use Illuminate\Extend\Service;

class FreeFlippableCardReturnService extends Service
{
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
            'card' => [function () {
                throw new \Exception();
            }],

            'is_free_time' => ['limited_min_time', 'evaluated_time', function ($limitedMinTime, $evaluatedTime) {
                return strtotime($limitedMinTime) <= strtotime($evaluatedTime);
            }],

            'limited_min_time' => [function () {
                return (new \DateTime())
                    ->modify('-1 day')
                    ->modify('+1 second')
                    ->format('Y-m-d H:i:s')
                ;
            }],

            'result' => ['card', 'is_free', function ($card, $isFree) {
                if ($isFree) {
                    return $card;
                }
            }],
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user' => ['required'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
