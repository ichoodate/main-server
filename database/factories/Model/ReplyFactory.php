<?php

namespace Database\Factories\Model;

use App\Models\Reply;
use Database\Factories\ModelFactory;

class ReplyFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Reply::ID => static::faker()->unique()->randomNumber(8),

            Reply::TICKET_ID => static::faker()->unique()->randomNumber(8),

            Reply::WRITER_ID => static::faker()->unique()->randomNumber(8),

            Reply::DESCRIPTION => static::faker()->text,

            Reply::CREATED_AT => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
