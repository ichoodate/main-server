<?php

namespace Database\Factories;

use App\Models\ProfilePhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfilePhotoFactory extends Factory
{
    protected $model = ProfilePhoto::class;

    public function definition()
    {
        return [
            ProfilePhoto::ID => $this->faker->unique()->randomNumber(8),

            ProfilePhoto::USER_ID => $this->faker->unique()->randomNumber(8),

            ProfilePhoto::DATA => $this->faker->text,

            ProfilePhoto::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
