<?php

namespace Database\Seeds\Table\Keyword;

use App\Database\Models\Keyword\Drink;
use Database\Seeds\TableSeeder;

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
