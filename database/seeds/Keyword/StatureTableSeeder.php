<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Stature;
use Database\TableSeeder;

class StatureTableSeeder extends TableSeeder {

    public function run()
    {
        foreach ( range(140, 200) as $type )
        {
            Stature::create([
                Stature::TYPE => $type
            ]);
        }
    }

}
