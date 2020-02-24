<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Keyword\Drink;
use Illuminate\Database\Seeder;

class DrinkTableSeeder extends Seeder {

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
