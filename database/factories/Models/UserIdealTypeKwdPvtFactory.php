<?php

namespace Database\Factories\Models;

use App\Database\Models\UserIdealTypeKwdPvt;
use Faker\Generator as Faker;

class UserIdealTypeKwdPvtFactory extends ModelFactory {

    public static function default()
    {
        return [
            UserIdealTypeKwdPvt::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            UserIdealTypeKwdPvt::USER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            UserIdealTypeKwdPvt::KEYWORD_ID
                => inst(Faker::class)->unique()->randomNumber(8)
        ];
    }

}
