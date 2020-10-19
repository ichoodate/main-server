<?php

namespace Database\Factories\Model;

use App\Database\Models\MatchingKwdPvt;
use Database\Factories\ModelFactory;

class MatchingKwdPvtFactory extends ModelFactory {

    public static function default()
    {
        return [
            MatchingKwdPvt::ID
                => static::faker()->unique()->randomNumber(8),

            MatchingKwdPvt::IDEAL_TYPE_KWD_ID
                => static::faker()->unique()->randomNumber(8),

            MatchingKwdPvt::MATCHING_KWD_ID
                => static::faker()->unique()->randomNumber(8)
        ];
    }

}
