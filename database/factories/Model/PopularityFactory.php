<?php

namespace Database\Factories\Model;

use App\Database\Models\Popularity;
use Database\Factories\ModelFactory;

class PopularityFactory extends ModelFactory {

    public static function default()
    {
        return [
            Popularity::ID
                => static::faker()->unique()->randomNumber(8),

            Popularity::SENDER_ID
                => static::faker()->unique()->randomNumber(8),

            Popularity::RECEIVER_ID
                => static::faker()->unique()->randomNumber(8),

            Popularity::POINT
                => static::faker()->numberBetween(0, 10),

            Popularity::CREATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }

}
