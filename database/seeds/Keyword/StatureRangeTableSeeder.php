<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\StatureRange;
use Database\TableSeeder;

class StatureRangeTableSeeder extends TableSeeder {

    public function run()
    {
        for ( $i = 140; $i <= 200;  $i++ )
        {
            for ( $j = 200; $j >= $i; $j-- )
            {
                StatureRange::create([
                    StatureRange::MIN => $i,
                    StatureRange::MAX => $j
                ]);
            }
        }
    }

}
