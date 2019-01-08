<?php

namespace Database\Seeds;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Body;

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
