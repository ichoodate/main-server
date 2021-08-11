<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\Language;
use Database\Factories\ModelFactory;

class LanguageFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Language::ID => static::faker()->unique()->randomNumber(8),

            Language::TYPE => static::faker()->unique()->randomElement(Language::TYPE_VALUES),
        ];
    }
}
