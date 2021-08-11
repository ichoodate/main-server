<?php

namespace Database\Factories\Model;

use App\Models\UserSelfKwdPvt;
use Database\Factories\ModelFactory;

class UserSelfKwdPvtFactory extends ModelFactory
{
    public static function default()
    {
        return [
            UserSelfKwdPvt::ID => static::faker()->unique()->randomNumber(8),

            UserSelfKwdPvt::USER_ID => static::faker()->unique()->randomNumber(8),

            UserSelfKwdPvt::KEYWORD_ID => static::faker()->unique()->randomNumber(8),
        ];
    }
}
