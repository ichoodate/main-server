<?php

namespace Database\Factories\Model\Keyword;

use App\Database\Models\Keyword\AgeRange;
use Faker\Generator as Faker;

class AgeRangeFactory extends ModelFactory {

    public static function default()
    {
        return [
            AgeRange::ID
                => inst(Faker::class)->unique()->randomNumber(),

            AgeRange::DATA
                => inst(Faker::class)->randomElement(AgeRange::DATA_VALUES)
        ];
    }

}
