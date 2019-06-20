<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Weight;
use Database\TableSeeder;

class WeightTableSeeder extends TableSeeder {

    public function run()
    {
        foreach ( range(40, 150) as $type )
        {
            Weight::create([
                Weight::TYPE => $type
            ]);
        }
    }

}
