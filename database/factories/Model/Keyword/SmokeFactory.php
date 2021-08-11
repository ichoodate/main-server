<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\Smoke;
use Database\Factories\ModelFactory;

class SmokeFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Smoke::ID => static::faker()->unique()->randomNumber(8),

            Smoke::TYPE => static::faker()->randomElement(Smoke::TYPE_VALUES),
        ];
    }
}
