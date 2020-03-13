<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\Career;
use Faker\Generator as Faker;

class CareerFactory extends ModelFactory {

    public static function default()
    {
        return [
            Career::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Career::PARENT_ID
                => inst(Faker::class)->randomElement([app(Faker::class)->unique()->randomNumber(8), null]),

            Career::TYPE
                => inst(Faker::class)->randomElement(Career::TYPE_VALUES),

            Career::NAME
                => inst(Faker::class)->word
        ];
    }

}
