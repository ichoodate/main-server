<?php

namespace Database\Factories\Model\Keyword;

use App\Database\Models\Keyword\Smoke;
use Faker\Generator as Faker;

class SmokeFactory extends ModelFactory {

    public static function default()
    {
        return [
            Smoke::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Smoke::TYPE
                => inst(Faker::class)->randomElement(Smoke::TYPE_VALUES)
        ];
    }

}
