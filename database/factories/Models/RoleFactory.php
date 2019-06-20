<?php

namespace Database\Factories\Models;

use App\Database\Models\Role;
use Faker\Generator as Faker;

class RoleFactory extends ModelFactory {

    public static function default()
    {
        return [
            Role::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Role::USER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Role::TYPE
                => inst(Faker::class)->unique()->word
        ];
    }

}
