<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\Language;
use Faker\Generator as Faker;

class LanguageFactory extends ModelFactory {

    public static function default()
    {
        return [
            Language::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Language::TYPE
                => inst(Faker::class)->unique()->randomElement(Language::TYPE_VALUES)
        ];
    }

}
