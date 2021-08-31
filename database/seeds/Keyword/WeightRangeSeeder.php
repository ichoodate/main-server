<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\WeightRange;
use Illuminate\Database\Seeder;

class WeightRangeSeeder extends Seeder
{
    public function run()
    {
        for ($i = 40; $i <= 150; ++$i) {
            for ($j = 150; $j >= $i; --$j) {
                $model = WeightRange::where([
                    WeightRange::MIN => $i,
                    WeightRange::MAX => $j,
                ])->first();

                if (empty($model)) {
                    WeightRange::factory()->create([
                        WeightRange::MIN => $i,
                        WeightRange::MAX => $j,
                    ]);
                }
            }
        }
    }
}
