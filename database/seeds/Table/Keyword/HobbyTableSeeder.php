<?php

namespace Database\Seeds\Table\Keyword;

use App\Models\Keyword\Hobby;
use Database\Seeds\TableSeeder;

class HobbyTableSeeder extends TableSeeder
{
    public function run()
    {
        foreach (Hobby::TYPE_VALUES as $type) {
            Hobby::create([
                Hobby::TYPE => $type,
            ]);
        }
    }
}
