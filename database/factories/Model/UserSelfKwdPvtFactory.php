<?php

namespace Database\Factories\Model;

use App\Database\Models\UserSelfKwdPvt;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class UserSelfKwdPvtFactory extends ModelFactory {

    public static function default()
    {
        return [
            UserSelfKwdPvt::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            UserSelfKwdPvt::USER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            UserSelfKwdPvt::KEYWORD_ID
                => inst(Faker::class)->unique()->randomNumber(8)
        ];
    }

}
