<?php

namespace Database\Factories\Model;

use App\Database\Models\MatchingKwdPvt;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class MatchingKwdPvtFactory extends ModelFactory {

    public static function default()
    {
        return [
            MatchingKwdPvt::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            MatchingKwdPvt::IDEAL_TYPE_KWD_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            MatchingKwdPvt::MATCHING_KWD_ID
                => inst(Faker::class)->unique()->randomNumber(8)
        ];
    }

}
