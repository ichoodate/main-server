<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Models\Keyword\Blood;

class BloodFactory extends ModelFactory {

    public static function default()
    {
        return [
            Blood::ID
                => static::faker()->unique()->randomNumber(8),

            Blood::TYPE
                => static::faker()->randomElement(Blood::TYPE_VALUES)
        ];
    }

}
