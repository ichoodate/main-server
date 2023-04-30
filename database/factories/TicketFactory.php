<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            Ticket::WRITER_ID => $this->faker->unique()->randomNumber(8),

            Ticket::SUBJECT => $this->faker->text,

            Ticket::DESCRIPTION => $this->faker->text,

            Ticket::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),

            Ticket::UPDATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
