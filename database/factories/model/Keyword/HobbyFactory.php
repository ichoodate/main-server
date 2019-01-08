<?php

namespace Database\Factories\Model\Keyword;

use App\Database\Models\Keyword\Hobby;
use Faker\Generator as Faker;

class HobbyFactory extends ModelFactory {

    public static function default()
    {
        return [
            Hobby::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Hobby::TYPE
                => inst(Faker::class)->randomElement(Hobby::TYPE_VALUES)
        ];
    }

}
