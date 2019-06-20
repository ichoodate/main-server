<?php

namespace Database\Factories\Models\Keyword;

use Database\Factories\Models\ModelFactory;
use App\Database\Models\Keyword\Stature;
use Faker\Generator as Faker;

class StatureFactory extends ModelFactory {

    public static function default()
    {
        return [
            Stature::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Stature::TYPE
                => inst(Faker::class)->numberBetween(140, 200)
        ];
    }

}
