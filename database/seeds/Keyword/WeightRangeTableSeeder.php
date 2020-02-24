<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\WeightRange;
use Illuminate\Database\Seeder;

class WeightRangeTableSeeder extends Seeder {

    public function run()
    {
        for ( $i = 40; $i <= 150;  $i++ )
        {
            for ( $j = 150; $j >= $i; $j-- )
            {
                WeightRange::create([
                    WeightRange::MIN => $i,
                    WeightRange::MAX => $j
                ]);
            }
        }
    }

}
