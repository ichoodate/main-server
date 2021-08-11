<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\Religion;
use Database\Factories\ModelFactory;

class ReligionFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Religion::ID => static::faker()->unique()->randomNumber(8),

            Religion::TYPE => static::faker()->randomElement(Religion::TYPE_VALUES),
        ];
    }
}
