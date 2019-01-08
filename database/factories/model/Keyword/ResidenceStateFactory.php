<?php

namespace Database\Factories\Model\Keyword;

use App\Database\Models\Keyword\ResidenceState;
use Faker\Generator as Faker;

class ResidenceStateFactory extends ModelFactory {

    public static function default()
    {
        return [
            ResidenceState::ID
                => inst(Faker::class)->unique()->randomNumber(),

            ResidenceState::STATE_ID
                => inst(Faker::class)->unique()->randomNumber()
        ];
    }

}
