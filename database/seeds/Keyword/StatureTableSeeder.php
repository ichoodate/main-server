<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Stature;
use Illuminate\Database\Seeder;

class StatureTableSeeder extends Seeder {

    public function run()
    {
        foreach ( range(140, 200) as $cm )
        {
            $stature = Stature::create([
                Stature::CM => $cm,
                Stature::INCH => (int)($cm * 0.393701)
            ]);
        }
    }

}
