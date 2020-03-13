<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\Smoke;
use Faker\Generator as Faker;

class SmokeFactory extends ModelFactory {

    public static function default()
    {
        return [
            Smoke::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Smoke::TYPE
                => inst(Faker::class)->randomElement(Smoke::TYPE_VALUES)
        ];
    }

}
