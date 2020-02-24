<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Body;
use Illuminate\Database\Seeder;

class BodyTableSeeder extends Seeder {

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
