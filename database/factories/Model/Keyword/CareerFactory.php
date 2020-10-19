<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\Career;

class CareerFactory extends ModelFactory {

    public static function default()
    {
        return [
            Career::ID
                => static::faker()->unique()->randomNumber(8),

            Career::PARENT_ID
                => static::faker()->randomElement([app(Faker::class)->unique()->randomNumber(8), null]),

            Career::TYPE
                => static::faker()->randomElement(Career::TYPE_VALUES),

            Career::NAME
                => static::faker()->word
        ];
    }

}
