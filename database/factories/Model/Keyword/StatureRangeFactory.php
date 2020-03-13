<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\StatureRange;
use Faker\Generator as Faker;

class StatureRangeFactory extends ModelFactory {

    public static function default()
    {
        return [
            StatureRange::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            StatureRange::MIN
                => inst(Faker::class)->numberBetween(140, 170),

            StatureRange::MAX
                => inst(Faker::class)->numberBetween(170, 200)
        ];
    }

}
