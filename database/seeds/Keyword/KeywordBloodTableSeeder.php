<?php

namespace Database\Seeds;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Blood;

class BloodTableSeeder extends TableSeeder {

    public function run()
    {
        foreach ( Blood::TYPE_VALUES as $type )
        {
            Blood::create([
                Blood::TYPE => $type
            ]);
        }
    }
}
