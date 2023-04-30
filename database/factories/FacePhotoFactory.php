<?php

namespace Database\Factories;

use App\Models\FacePhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacePhotoFactory extends Factory
{
    protected $model = FacePhoto::class;

    public function definition()
    {
        return [
            FacePhoto::USER_ID => $this->faker->unique()->randomNumber(8),

            FacePhoto::DATA => $this->faker->text,

            FacePhoto::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
