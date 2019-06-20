<?php

namespace Database\Factories\Models;

use App\Database\Models\User;
use Faker\Generator as Faker;

class UserFactory extends ModelFactory {

    public static function default()
    {
        return [
            User::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            User::EMAIL
                => inst(Faker::class)->unique()->email,

            User::PASSWORD
                => inst(Faker::class)->password,

            User::BIRTH
                => inst(Faker::class)->dateTime->format('Y-m-d'),

            User::GENDER
                => inst(Faker::class)->randomElement(User::GENDER_VALUES),

            User::NAME
                => inst(Faker::class)->name(),

            User::EMAIL_VERIFIED
                => inst(Faker::class)->boolean,

            User::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }

}
