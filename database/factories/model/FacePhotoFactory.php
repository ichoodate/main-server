<?php

namespace Database\Factories\Model;

use App\Database\Models\FacePhoto;
use Faker\Generator as Faker;

class FacePhotoFactory extends ModelFactory {

    public static function default()
    {
        return [
            FacePhoto::ID
                => inst(Faker::class)->unique()->randomNumber(),

            FacePhoto::USER_ID
                => inst(Faker::class)->unique()->randomNumber(),

            FacePhoto::DATA
                => inst(Faker::class)->text,

            FacePhoto::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
