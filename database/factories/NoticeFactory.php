<?php

namespace Database\Factories;

use App\Models\Notice;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoticeFactory extends Factory
{
    protected $model = Notice::class;

    public function definition()
    {
        return [
            Notice::TYPE => $this->faker->randomElement(Notice::TYPE_VALUES),

            Notice::SUBJECT => $this->faker->text,

            Notice::DESCRIPTION => $this->faker->text,

            Notice::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
