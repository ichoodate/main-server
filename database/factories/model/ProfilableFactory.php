<?php

namespace Database\Factories\Model;

use App\Database\Models\Profilable;
use Faker\Generator as Faker;

class ProfilableFactory extends ModelFactory {

    public static function default()
    {
        return [
            Profilable::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Profilable::USER_ID
                => inst(Faker::class)->unique()->randomNumber(),

            Profilable::KEYWORD_ID
                => inst(Faker::class)->unique()->randomNumber(),

            Profilable::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),

            Profilable::DELETED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
