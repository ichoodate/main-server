<?php

namespace Database\Factories\Model\Keyword;

use App\Database\Models\Keyword\StatureRange;
use Faker\Generator as Faker;

class StatureRangeFactory extends ModelFactory {

    public static function default()
    {
        return [
            StatureRange::ID
                => inst(Faker::class)->unique()->randomNumber(),

            StatureRange::DATA
                => inst(Faker::class)->randomElement(StatureRange::DATA_VALUES)
        ];
    }

}
