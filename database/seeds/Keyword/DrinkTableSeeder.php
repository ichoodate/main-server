<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Keyword\Drink;
use Database\TableSeeder;

class DrinkTableSeeder extends TableSeeder {

    public function run()
    {
        foreach ( Drink::TYPE_VALUES as $type )
        {
            Drink::create([
                Drink::TYPE => $type
            ]);
        }
    }

}
