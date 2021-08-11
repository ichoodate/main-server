<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Models\Keyword\State;

class StateFactory extends ModelFactory {

    public static function default()
    {
        return [
            State::ID
                => static::faker()->unique()->randomNumber(8),

            State::COUNTRY_ID
                => static::faker()->unique()->randomNumber(8),

            State::NAME
                => static::faker()->word
        ];
    }

}
