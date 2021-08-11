<?php

namespace Database\Factories\Model;

use App\Models\PwdReset;
use Database\Factories\ModelFactory;

class PwdResetFactory extends ModelFactory {

    public static function default()
    {
        return [
            PwdReset::ID
                => static::faker()->unique()->randomNumber(8),

            PwdReset::EMAIL
                => static::faker()->unique()->randomNumber(8),

            PwdReset::TOKEN
                => static::faker()->unique()->md5,

            PwdReset::COMPLETE
                => static::faker()->boolean,

            PwdReset::CREATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),

            PwdReset::UPDATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
