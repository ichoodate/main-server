<?php

namespace Database\Factories\Model;

use App\Database\Models\Ticket;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class TicketFactory extends ModelFactory {

    public static function default()
    {
        return [
            Ticket::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Ticket::WRITER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Ticket::SUBJECT
                => inst(Faker::class)->text,

            Ticket::DESCRIPTION
                => inst(Faker::class)->text,

            Ticket::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),

            Ticket::UPDATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
