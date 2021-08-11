<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Models\Keyword\Hobby;

class HobbyFactory extends ModelFactory {

    public static function default()
    {
        return [
            Hobby::ID
                => static::faker()->unique()->randomNumber(8),

            Hobby::TYPE
                => static::faker()->randomElement(Hobby::TYPE_VALUES)
        ];
    }

}
