<?php

namespace Database\Factories\Model;

use App\Models\User;
use Database\Factories\ModelFactory;

class UserFactory extends ModelFactory {

    public static function default()
    {
        return [
            User::ID
                => static::faker()->unique()->randomNumber(8),

            User::EMAIL
                => static::faker()->unique()->email,

            User::PASSWORD
                => static::faker()->password,

            User::BIRTH
                => static::faker()->dateTime->format('Y-m-d'),

            User::GENDER
                => static::faker()->randomElement(User::GENDER_VALUES),

            User::NAME
                => static::faker()->name(),

            User::EMAIL_VERIFIED
                => static::faker()->boolean,

            User::CREATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }

}
