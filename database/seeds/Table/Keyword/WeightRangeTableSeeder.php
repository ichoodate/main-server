<?php

namespace Database\Seeds\Table\Keyword;

use App\Models\Obj;
use App\Models\Keyword\WeightRange;
use Database\Seeds\TableSeeder;

class WeightRangeTableSeeder extends TableSeeder {

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
