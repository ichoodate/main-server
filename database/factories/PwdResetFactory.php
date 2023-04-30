<?php

namespace Database\Factories;

use App\Models\PwdReset;
use Illuminate\Database\Eloquent\Factories\Factory;

class PwdResetFactory extends Factory
{
    protected $model = PwdReset::class;

    public function definition()
    {
        return [
            PwdReset::EMAIL => $this->faker->unique()->randomNumber(8),

            PwdReset::TOKEN => $this->faker->unique()->md5,

            PwdReset::COMPLETE => $this->faker->boolean,

            PwdReset::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),

            PwdReset::UPDATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
