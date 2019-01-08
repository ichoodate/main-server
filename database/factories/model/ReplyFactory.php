<?php

namespace Database\Factories\Model;

use App\Database\Models\Reply;
use Faker\Generator as Faker;

class ReplyFactory extends ModelFactory {

    public static function default()
    {
        return [
            Reply::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Reply::TICKET_ID
                => inst(Faker::class)->unique()->randomNumber(),

            Reply::WRITER_ID
                => inst(Faker::class)->unique()->randomNumber(),

            Reply::DESCRIPTION
                => inst(Faker::class)->text,

            Reply::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
