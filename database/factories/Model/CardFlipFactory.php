<?php

namespace Database\Factories\Model;

use App\Models\CardFlip;
use Database\Factories\ModelFactory;

class CardFlipFactory extends ModelFactory
{
    public static function default()
    {
        return [
            CardFlip::ID => static::faker()->unique()->randomNumber(8),

            CardFlip::USER_ID => static::faker()->unique()->randomNumber(8),

            CardFlip::CARD_ID => static::faker()->unique()->randomNumber(8),

            CardFlip::CREATED_AT => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
