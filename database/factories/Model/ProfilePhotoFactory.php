<?php

namespace Database\Factories\Model;

use App\Database\Models\ProfilePhoto;
use Database\Factories\ModelFactory;

class ProfilePhotoFactory extends ModelFactory {

    public static function default()
    {
        return [
            ProfilePhoto::ID
                => static::faker()->unique()->randomNumber(8),

            ProfilePhoto::USER_ID
                => static::faker()->unique()->randomNumber(8),

            ProfilePhoto::DATA
                => static::faker()->text,

            ProfilePhoto::CREATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
