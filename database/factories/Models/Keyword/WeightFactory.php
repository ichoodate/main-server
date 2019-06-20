<?php

namespace Database\Factories\Models\Keyword;

use Database\Factories\Models\ModelFactory;
use App\Database\Models\Keyword\Weight;
use Faker\Generator as Faker;

class WeightFactory extends ModelFactory {

    public static function default()
    {
        return [
            Weight::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Weight::TYPE
                => inst(Faker::class)->numberBetween(40, 120)
        ];
    }

}
