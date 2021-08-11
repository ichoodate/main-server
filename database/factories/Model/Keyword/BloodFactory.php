<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\Blood;
use Database\Factories\ModelFactory;

class BloodFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Blood::ID => static::faker()->unique()->randomNumber(8),

            Blood::TYPE => static::faker()->randomElement(Blood::TYPE_VALUES),
        ];
    }
}
