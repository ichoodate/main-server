<?php

namespace Database\Seeds\Table\Keyword;

use App\Models\Keyword\Stature;
use Database\Seeds\TableSeeder;

class StatureTableSeeder extends TableSeeder
{
    public function run()
    {
        foreach (range(140, 200) as $cm) {
            $stature = Stature::create([
                Stature::CM => $cm,
                Stature::INCH => (int) ($cm * 0.393701),
            ]);
        }
    }
}
