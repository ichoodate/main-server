<?php

namespace Database\Factories\Models\Keyword;

use Database\Factories\Models\ModelFactory;
use App\Database\Models\Keyword\Drink;
use Faker\Generator as Faker;

class DrinkFactory extends ModelFactory {

    public static function default()
    {
        return [
            Drink::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Drink::TYPE
                => inst(Faker::class)->randomElement(Drink::TYPE_VALUES)
        ];
    }

}
