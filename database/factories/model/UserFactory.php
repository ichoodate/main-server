<?php

namespace Database\Factories\Model;

use App\Database\Models\User;
use Faker\Generator as Faker;

class UserFactory extends ModelFactory {

    public static function default()
    {
        return [
            User::ID
                => inst(Faker::class)->unique()->randomNumber(),

            User::EMAIL
                => inst(Faker::class)->unique()->email,

            User::PASSWORD
                => inst(Faker::class)->password,

            User::BIRTH
                => inst(Faker::class)->dateTimeThisCentury->format('Y-m-d'),

            User::GENDER
                => inst(Faker::class)->randomElement(User::GENDER_VALUES),

            User::NAME
                => inst(Faker::class)->name(),

            User::ACTIVE
                => inst(Faker::class)->boolean,

            User::COIN
                => inst(Faker::class)->numberBetween(10000, 100000),

            User::REMEMBER_TOKEN
                => inst(Faker::class)->sha256,

            User::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }

}
