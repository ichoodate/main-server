<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Hobby;
use Database\TableSeeder;

class HobbyTableSeeder extends TableSeeder {

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
