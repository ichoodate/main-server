<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Models\Keyword\Religion;

class ReligionFactory extends ModelFactory {

    public static function default()
    {
        return [
            Religion::ID
                => static::faker()->unique()->randomNumber(8),

            Religion::TYPE
                => static::faker()->randomElement(Religion::TYPE_VALUES)
        ];
    }

}
