<?php

namespace Database\Factories\Model\Keyword;

use App\Database\Models\Keyword\Character;
use Faker\Generator as Faker;

class CharacterFactory extends ModelFactory {

    public static function default()
    {
        return [
            Character::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Character::TYPE
                => inst(Faker::class)->randomElement(Character::TYPE_VALUES)
        ];
    }

}
