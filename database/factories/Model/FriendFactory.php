<?php

namespace Database\Factories\Models;

use App\Database\Models\Friend;

class FriendFactory extends ModelFactory {

    public static function default()
    {
        return [
            Friend::ID
                => static::faker()->unique()->randomNumber(8),

            Friend::SENDER_ID
                => static::faker()->unique()->randomNumber(8),

            Friend::RECEIVER_ID
                => static::faker()->unique()->randomNumber(8),

            Friend::MATCH_ID
                => static::faker()->unique()->randomNumber(8),

            Friend::CREATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
