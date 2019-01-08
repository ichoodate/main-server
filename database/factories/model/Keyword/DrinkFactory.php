<?php

namespace Database\Factories\Model\Keyword;

use App\Database\Models\Keyword\Drink;
use Faker\Generator as Faker;

class DrinkFactory extends ModelFactory {

    public static function default()
    {
        return [
            Drink::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Drink::TYPE
                => inst(Faker::class)->randomElement(Drink::TYPE_VALUES)
        ];
    }

}
