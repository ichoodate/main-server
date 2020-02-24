<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Hobby;
use Illuminate\Database\Seeder;

class HobbyTableSeeder extends Seeder {

    public function run()
    {
        foreach ( Hobby::TYPE_VALUES as $type )
        {
            Hobby::create([
                Hobby::TYPE => $type
            ]);
        }
    }

}
