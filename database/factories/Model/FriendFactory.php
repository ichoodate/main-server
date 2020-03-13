<?php

namespace Database\Factories\Models;

use App\Database\Models\Friend;
use Faker\Generator as Faker;

class FriendFactory extends ModelFactory {

    public static function default()
    {
        return [
            Friend::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Friend::SENDER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Friend::RECEIVER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Friend::MATCH_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Friend::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
