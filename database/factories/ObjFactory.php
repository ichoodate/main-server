<?php

namespace Database\Factories;

use App\Models\Obj;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObjFactory extends Factory
{
    protected $model = Obj::class;

    public function definition()
    {
        return [
            Obj::TYPE => $this->faker->randomElement(Obj::TYPE_VALUES),
        ];
    }
}
