<?php

namespace Database\Factories\Model\Keyword;

use App\Database\Models\Keyword\Language;
use Faker\Generator as Faker;

class LanguageFactory extends ModelFactory {

    public static function default()
    {
        return [
            Language::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Language::TYPE
                => inst(Faker::class)->randomElement(Language::TYPE_VALUES)
        ];
    }

}
