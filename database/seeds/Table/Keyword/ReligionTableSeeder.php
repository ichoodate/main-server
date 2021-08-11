<?php

namespace Database\Seeds\Table\Keyword;

use App\Models\Obj;
use App\Models\Keyword\Religion;
use Database\Seeds\TableSeeder;

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
