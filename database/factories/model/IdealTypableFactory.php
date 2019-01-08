<?php

namespace Database\Factories\Model;

use App\Database\Models\IdealTypable;
use Faker\Generator as Faker;

class IdealTypableFactory extends ModelFactory {

    public static function default()
    {
        return [
            IdealTypable::ID
                => inst(Faker::class)->unique()->randomNumber(),

            IdealTypable::USER_ID
                => inst(Faker::class)->unique()->randomNumber(),

            IdealTypable::KEYWORD_ID
                => inst(Faker::class)->unique()->randomNumber(),

            IdealTypable::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),

            IdealTypable::DELETED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
