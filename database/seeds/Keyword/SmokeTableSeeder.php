<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Smoke;
use Illuminate\Database\Seeder;

class SmokeTableSeeder extends Seeder {

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
