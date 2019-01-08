<?php

namespace Database\Factories\Model;

use App\Database\Models\ProfilePhoto;
use Faker\Generator as Faker;

class ProfilePhotoFactory extends ModelFactory {

    public static function default()
    {
        return [
            ProfilePhoto::ID
                => inst(Faker::class)->unique()->randomNumber(),

            ProfilePhoto::USER_ID
                => inst(Faker::class)->unique()->randomNumber(),

            ProfilePhoto::DATA
                => inst(Faker::class)->text,

            ProfilePhoto::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
