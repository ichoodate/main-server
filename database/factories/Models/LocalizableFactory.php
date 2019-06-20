<?php

namespace Database\Factories\Models;

use App\Database\Models\Localizable;
use Faker\Generator as Faker;

class LocalizableFactory extends ModelFactory {

    public static function default()
    {
        return [
            Localizable::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Localizable::KEYWORD_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Localizable::LANGUAGE
                => inst(Faker::class)->randomElement(Localizable::LANGUAGE_VALUES),

            Localizable::TEXT
                => inst(Faker::class)->word
        ];
    }

}
