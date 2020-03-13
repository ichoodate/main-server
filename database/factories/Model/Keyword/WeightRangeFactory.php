<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\WeightRange;
use Faker\Generator as Faker;

class WeightRangeFactory extends ModelFactory {

    public static function default()
    {
        return [
            WeightRange::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            WeightRange::MIN
                => inst(Faker::class)->numberBetween(40, 80),

            WeightRange::MAX
                => inst(Faker::class)->numberBetween(60, 100)
        ];
    }

}
