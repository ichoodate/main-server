<?php

namespace Database\Factories\Model;

use App\Database\Models\CardFlip;
use App\Database\Models\Card;
use App\Database\Models\Obj;
use App\Database\Models\Match;
use Database\Factories\ModelFactory;

class CardFactory extends ModelFactory {

    public static function create(array $data = [])
    {
        $data  = array_add($data, Card::FLIPS, []);
        $model = parent::create($data);

        foreach ( $data[Card::FLIPS] as $flip  )
        {
            if ( ! array_key_exists(CardFlip::USER_ID, $flip) )
            {
                $addableUserIds = array_values(array_only($data, [
                    Card::CHOOSER_ID, Card::SHOWNER_ID
                ]));

                shuffle($addableUserIds);

                $flip[CardFlip::USER_ID] = $addableUserIds[0];
            }

            $flip[CardFlip::CARD_ID] = $model->getKey();

            static::factory(CardFlip::class)->create($flip);
        }

        return $model;
    }

    public static function default()
    {
        return [
            Card::ID
                => static::faker()->unique()->randomNumber(8),

            Card::GROUP_ID
                => static::faker()->unique()->randomNumber(8),

            Card::MATCH_ID
                => static::faker()->unique()->randomNumber(8),

            Card::CHOOSER_ID
                => static::faker()->unique()->randomNumber(8),

            Card::SHOWNER_ID
                => static::faker()->unique()->randomNumber(8),

            Card::CREATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),

            Card::UPDATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
