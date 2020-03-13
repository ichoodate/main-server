<?php

namespace Database\Seeds\Table\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Smoke;
use Database\Seeds\TableSeeder;

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
