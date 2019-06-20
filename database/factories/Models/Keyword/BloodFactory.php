<?php

namespace Database\Factories\Models\Keyword;

use Database\Factories\Models\ModelFactory;
use App\Database\Models\Keyword\Blood;
use Faker\Generator as Faker;

class BloodFactory extends ModelFactory {

    public static function default()
    {
        return [
            Blood::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Blood::TYPE
                => inst(Faker::class)->randomElement(Blood::TYPE_VALUES)
        ];
    }

}
