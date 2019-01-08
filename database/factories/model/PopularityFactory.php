<?php

namespace Database\Factories\Model;

use App\Database\Models\Popularity;
use Faker\Generator as Faker;

class PopularityFactory extends ModelFactory {

    public static function default()
    {
        return [
            Popularity::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Popularity::SENDER_ID
                => inst(Faker::class)->unique()->randomNumber(),

            Popularity::RECEIVER_ID
                => inst(Faker::class)->unique()->randomNumber(),

            Popularity::POINT
                => inst(Faker::class)->numberBetween(0, 10),

            Popularity::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }

}
