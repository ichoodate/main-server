<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\Career;
use Database\Factories\ModelFactory;

class CareerFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Career::ID => static::faker()->unique()->randomNumber(8),

            Career::PARENT_ID => static::faker()->randomElement([app(Faker::class)->unique()->randomNumber(8), null]),

            Career::TYPE => static::faker()->randomElement(Career::TYPE_VALUES),

            Career::NAME => static::faker()->word,
        ];
    }
}
