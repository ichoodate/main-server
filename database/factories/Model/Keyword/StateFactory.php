<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\State;
use Faker\Generator as Faker;

class StateFactory extends ModelFactory {

    public static function default()
    {
        return [
            State::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            State::COUNTRY_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            State::NAME
                => inst(Faker::class)->word
        ];
    }

}
