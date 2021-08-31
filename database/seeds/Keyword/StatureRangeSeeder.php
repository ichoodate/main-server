<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\StatureRange;
use Illuminate\Database\Seeder;

class StatureRangeSeeder extends Seeder
{
    public function run()
    {
        for ($i = 140; $i <= 200; ++$i) {
            for ($j = 200; $j >= $i; --$j) {
                StatureRange::create([
                    StatureRange::MIN => $i,
                    StatureRange::MAX => $j,
                ]);
            }
        }
    }
}
