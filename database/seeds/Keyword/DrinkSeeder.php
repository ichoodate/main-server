<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Drink;
use Database\DatabaseSeeder;

class DrinkSeeder extends DatabaseSeeder
{
    public function run()
    {
        foreach (Drink::TYPE_VALUES as $type) {
            $model = Drink::where([
                Drink::TYPE => $type,
            ])->first();

            if (empty($model)) {
                Drink::factory()->create([
                    Drink::TYPE => $type,
                ]);
            }
        }
    }
}
