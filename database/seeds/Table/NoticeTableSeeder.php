<?php

namespace Database\Seeds\Table;

use App\Database\Models\Notice;
use Database\Seeds\TableSeeder;

class NoticeTableSeeder extends TableSeeder {

    public function run()
    {
        for( $i = 0; $i < 100; $i++ )
        {
           $this->factory(Notice::class)->create();
        }
    }

}
