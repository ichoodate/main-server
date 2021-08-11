<?php

namespace Database\Factories\Model;

use App\Models\Localizable;
use Database\Factories\ModelFactory;

class LocalizableFactory extends ModelFactory {

    public static function default()
    {
        return [
            Localizable::ID
                => static::faker()->unique()->randomNumber(8),

            Localizable::KEYWORD_ID
                => static::faker()->unique()->randomNumber(8),

            Localizable::LANGUAGE
                => static::faker()->randomElement(Localizable::LANGUAGE_VALUES),

            Localizable::TEXT
                => static::faker()->word
        ];
    }

}
