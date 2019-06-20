<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Keyword\AgeRange;
use Database\TableSeeder;

class AgeRangeTableSeeder extends TableSeeder {

    public function run()
    {
        for ($i=19; $i <= 49; $i++)
        {
            for ($j=$i+1; $j <= 50; $j++)
            {
                AgeRange::create([
                    AgeRange::MIN => $i,
                    AgeRange::MAX => $j
                ]);
            }
        }
    }

}
