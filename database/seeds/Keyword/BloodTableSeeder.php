<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Blood;
use Illuminate\Database\Seeder;

class BloodTableSeeder extends Seeder {

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
