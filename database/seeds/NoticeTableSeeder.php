<?php

namespace Database\Seeds;

use App\Database\Models\Notice;

class NoticeTableSeeder extends TableSeeder {

    public function run()
    {
        for( $i = 0; $i < 100; $i++ )
        {
           $this->factory(Notice::class)->create();
        }
    }

}
