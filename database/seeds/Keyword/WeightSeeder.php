<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Weight;
use Illuminate\Database\Seeder;

class WeightSeeder extends Seeder
{
    public function run()
    {
        foreach (range(40, 150) as $type) {
            $model = Weight::where([
                Weight::TYPE => $type,
            ])->first();

            if (empty($model)) {
                Weight::factory()->create([
                    Weight::TYPE => $type,
                ]);
            }
        }
    }
}
