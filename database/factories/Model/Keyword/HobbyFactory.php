<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\Hobby;
use Faker\Generator as Faker;

class HobbyFactory extends ModelFactory {

    public static function default()
    {
        return [
            Hobby::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Hobby::TYPE
                => inst(Faker::class)->randomElement(Hobby::TYPE_VALUES)
        ];
    }

}
