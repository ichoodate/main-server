<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Body;
use Database\TableSeeder;

class BodyTableSeeder extends TableSeeder {

    public function run()
    {
        foreach ( Body::TYPE_VALUES as $type )
        {
            Body::create([
                Body::TYPE => $type
            ]);
        }
    }

}
