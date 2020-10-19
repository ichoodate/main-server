<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\Language;

class LanguageFactory extends ModelFactory {

    public static function default()
    {
        return [
            Language::ID
                => static::faker()->unique()->randomNumber(8),

            Language::TYPE
                => static::faker()->unique()->randomElement(Language::TYPE_VALUES)
        ];
    }

}
