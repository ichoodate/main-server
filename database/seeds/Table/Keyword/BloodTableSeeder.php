<?php

namespace Database\Seeds\Table\Keyword;

use App\Models\Keyword\Blood;
use Database\Seeds\TableSeeder;

class BloodTableSeeder extends TableSeeder
{
    public function run()
    {
        foreach (Blood::TYPE_VALUES as $type) {
            Blood::create([
                Blood::TYPE => $type,
            ]);
        }
    }
}
