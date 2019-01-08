<?php

namespace Database\Seeds;

use App\Database\Models\Obj;

class ObjTableSeeder extends TableSeeder {

    public function run()
    {
        for ( $i = 0; $i < 1000000; $i++ )
        {
           $this->factory(Obj::class)->create();
        }
    }

}
