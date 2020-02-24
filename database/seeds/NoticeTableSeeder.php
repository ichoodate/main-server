<?php

namespace Database\Seeds;

use App\Database\Models\Notice;
use Illuminate\Database\Seeder;

class NoticeTableSeeder extends Seeder {

    public function run()
    {
        for( $i = 0; $i < 100; $i++ )
        {
           $this->factory(Notice::class)->create();
        }
    }

}
