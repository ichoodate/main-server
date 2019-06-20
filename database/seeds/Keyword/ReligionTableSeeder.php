<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Religion;
use Database\TableSeeder;

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
