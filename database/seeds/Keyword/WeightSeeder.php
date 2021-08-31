<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Weight;
use Illuminate\Database\Seeder;

class WeightSeeder extends Seeder
{
    public function run()
    {
        foreach (range(40, 150) as $type) {
            Weight::create([
                Weight::TYPE => $type,
            ]);
        }
    }
}
