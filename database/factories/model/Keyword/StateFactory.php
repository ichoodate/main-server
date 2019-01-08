<?php

namespace Database\Factories\Model\Keyword;

use App\Database\Models\Keyword\State;
use Faker\Generator as Faker;

class StateFactory extends ModelFactory {

    public static function default()
    {
        return [
            State::ID
                => inst(Faker::class)->unique()->randomNumber(),

            State::COUNTRY_ID
                => inst(Faker::class)->unique()->randomNumber(),

            State::NAME
                => inst(Faker::class)->word
        ];
    }

}
