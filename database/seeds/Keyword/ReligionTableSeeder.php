<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Religion;
use Illuminate\Database\Seeder;

class ReligionTableSeeder extends Seeder {

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
