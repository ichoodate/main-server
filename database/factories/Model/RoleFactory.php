<?php

namespace Database\Factories\Model;

use App\Database\Models\Role;
use Database\Factories\ModelFactory;
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
