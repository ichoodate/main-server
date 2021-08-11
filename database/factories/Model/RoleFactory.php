<?php

namespace Database\Factories\Model;

use App\Models\Role;
use Database\Factories\ModelFactory;

class RoleFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Role::ID => static::faker()->unique()->randomNumber(8),

            Role::USER_ID => static::faker()->unique()->randomNumber(8),

            Role::TYPE => static::faker()->unique()->word,
        ];
    }
}
