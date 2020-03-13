<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\AgeRange;
use Faker\Generator as Faker;

class AgeRangeFactory extends ModelFactory {

    public static function default()
    {
        return [
            AgeRange::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            AgeRange::MIN
                => inst(Faker::class)->numberBetween(20, 40),

            AgeRange::MAX
                => inst(Faker::class)->numberBetween(30, 50)
        ];
    }

}
