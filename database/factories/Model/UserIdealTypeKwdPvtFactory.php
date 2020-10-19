<?php

namespace Database\Factories\Model;

use App\Database\Models\UserIdealTypeKwdPvt;
use Database\Factories\ModelFactory;

class UserIdealTypeKwdPvtFactory extends ModelFactory {

    public static function default()
    {
        return [
            UserIdealTypeKwdPvt::ID
                => static::faker()->unique()->randomNumber(8),

            UserIdealTypeKwdPvt::USER_ID
                => static::faker()->unique()->randomNumber(8),

            UserIdealTypeKwdPvt::KEYWORD_ID
                => static::faker()->unique()->randomNumber(8)
        ];
    }

}
