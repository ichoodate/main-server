<?php

namespace Database\Seeds;

use App\Database\Models\Keyword\Drink;

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
