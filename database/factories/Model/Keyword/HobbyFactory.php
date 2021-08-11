<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\Hobby;
use Database\Factories\ModelFactory;

class HobbyFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Hobby::ID => static::faker()->unique()->randomNumber(8),

            Hobby::TYPE => static::faker()->randomElement(Hobby::TYPE_VALUES),
        ];
    }
}
