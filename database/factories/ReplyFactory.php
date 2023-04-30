<?php

namespace Database\Factories;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    protected $model = Reply::class;

    public function definition()
    {
        return [
            Reply::TICKET_ID => $this->faker->unique()->randomNumber(8),

            Reply::WRITER_ID => $this->faker->unique()->randomNumber(8),

            Reply::DESCRIPTION => $this->faker->text,

            Reply::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
