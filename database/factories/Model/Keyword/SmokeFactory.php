<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\Smoke;

class SmokeFactory extends ModelFactory {

    public static function default()
    {
        return [
            Smoke::ID
                => static::faker()->unique()->randomNumber(8),

            Smoke::TYPE
                => static::faker()->randomElement(Smoke::TYPE_VALUES)
        ];
    }

}
