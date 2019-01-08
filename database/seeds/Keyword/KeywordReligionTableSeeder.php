<?php

namespace Database\Seeds;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Religion;

class ReligionTableSeeder extends TableSeeder {

    public function run()
    {
        foreach ( Religion::TYPE_VALUES as $type )
        {
            Religion::create([
                Religion::TYPE => $type
            ]);
        }
    }

}
