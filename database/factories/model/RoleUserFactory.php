<?php

namespace Database\Factories\Model;

use App\Database\Models\RoleUser;
use Faker\Generator as Faker;

class RoleUserFactory extends ModelFactory {

    public static function default()
    {
        return [
            RoleUser::ROLE_ID
                => inst(Faker::class)->unique()->randomNumber(),

            RoleUser::USER_ID
                => inst(Faker::class)->unique()->randomNumber(),

            RoleUser::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
