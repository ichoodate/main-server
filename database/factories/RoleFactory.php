<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            Role::USER_ID => $this->faker->unique()->randomNumber(8),

            Role::TYPE => $this->faker->unique()->word,
        ];
    }
}
