<?php

namespace Database\Factories\Model;

use App\Database\Models\Role;
use Faker\Generator as Faker;

class RoleFactory extends ModelFactory {

    public static function default()
    {
        return [
            Role::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Role::TYPE
                => inst(Faker::class)->randomElement(Role::TYPE_VALUES)
        ];
    }

}
