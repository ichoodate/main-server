<?php

namespace Database\Factories\Model\Keyword;

use App\Database\Models\Keyword\Career;
use Faker\Generator as Faker;

class CareerFactory extends ModelFactory {

    public static function default()
    {
        return [
            Career::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Career::PARENT_ID
                => inst(Faker::class)->randomElement([app(Faker::class)->unique()->randomNumber(), null]),

            Career::CODE
                => inst(Faker::class)->word,

            Career::CATEGORY
                => inst(Faker::class)->randomElement(Career::CATEGORY_VALUES)
        ];
    }

}
