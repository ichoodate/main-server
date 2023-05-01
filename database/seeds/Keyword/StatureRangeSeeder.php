<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\StatureRange;
use Database\DatabaseSeeder;

class StatureRangeSeeder extends DatabaseSeeder
{
    public function run()
    {
        for ($i = 140; $i <= 200; ++$i) {
            for ($j = 200; $j >= $i; --$j) {
                $model = StatureRange::where([
                    StatureRange::MIN => $i,
                    StatureRange::MAX => $j,
                ])->first();

                if (empty($model)) {
                    StatureRange::factory()->create([
                        StatureRange::MIN => $i,
                        StatureRange::MAX => $j,
                    ]);
                }
            }
        }
    }
}
