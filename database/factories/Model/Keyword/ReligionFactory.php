<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\Religion;
use Faker\Generator as Faker;

class ReligionFactory extends ModelFactory {

    public static function default()
    {
        return [
            Religion::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Religion::TYPE
                => inst(Faker::class)->randomElement(Religion::TYPE_VALUES)
        ];
    }

}
