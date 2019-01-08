<?php

namespace Database\Seeds;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Smoke;

class SmokeTableSeeder extends TableSeeder {

    public function run()
    {
        foreach ( Smoke::TYPE_VALUES as $type )
        {
            Smoke::create([
                Smoke::TYPE => $type
            ]);
        }
    }
}
