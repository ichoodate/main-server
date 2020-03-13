<?php

namespace Database\Factories\Model;

use App\Database\Models\ProfilePhoto;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class ProfilePhotoFactory extends ModelFactory {

    public static function default()
    {
        return [
            ProfilePhoto::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            ProfilePhoto::USER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            ProfilePhoto::DATA
                => inst(Faker::class)->text,

            ProfilePhoto::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
