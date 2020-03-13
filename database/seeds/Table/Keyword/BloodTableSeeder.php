<?php

namespace Database\Seeds\Table\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Blood;
use Database\Seeds\TableSeeder;

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
