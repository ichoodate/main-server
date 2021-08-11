<?php

namespace Database\Factories\Model;

use App\Models\Ticket;
use Database\Factories\ModelFactory;

class TicketFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Ticket::ID => static::faker()->unique()->randomNumber(8),

            Ticket::WRITER_ID => static::faker()->unique()->randomNumber(8),

            Ticket::SUBJECT => static::faker()->text,

            Ticket::DESCRIPTION => static::faker()->text,

            Ticket::CREATED_AT => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),

            Ticket::UPDATED_AT => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
