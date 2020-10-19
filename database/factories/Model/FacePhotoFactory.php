<?php

namespace Database\Factories\Model;

use App\Database\Models\FacePhoto;
use Database\Factories\ModelFactory;

class FacePhotoFactory extends ModelFactory {

    public static function default()
    {
        return [
            FacePhoto::ID
                => static::faker()->unique()->randomNumber(8),

            FacePhoto::USER_ID
                => static::faker()->unique()->randomNumber(8),

            FacePhoto::DATA
                => static::faker()->text,

            FacePhoto::CREATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
