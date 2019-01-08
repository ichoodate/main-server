<?php

namespace Database\Factories\Model;

use App\Database\Models\Localizable;
use Faker\Generator as Faker;

class LocalizableFactory extends ModelFactory {

    public static function default()
    {
        return [
            Localizable::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Localizable::KEYWORD_ID
                => inst(Faker::class)->unique()->randomNumber(),

            Localizable::LANGUAGE
                => inst(Faker::class)->randomElement(Localizable::LANGUAGE_VALUES),

            Localizable::TEXT
                => inst(Faker::class)->word
        ];
    }

}
