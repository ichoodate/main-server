<?php

namespace Database\Seeds\Table;

use App\Models\Notice;
use Database\Seeds\TableSeeder;

class NoticeTableSeeder extends TableSeeder
{
    public function run()
    {
        for ($i = 0; $i < 100; ++$i) {
            Notice::factory()->create();
        }
    }
}
