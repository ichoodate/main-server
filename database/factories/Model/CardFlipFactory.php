<?php

namespace Database\Factories\Model;

use App\Database\Models\CardFlip;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class CardFlipFactory extends ModelFactory {

    public static function default()
    {
        return [
            CardFlip::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            CardFlip::USER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            CardFlip::CARD_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            CardFlip::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
