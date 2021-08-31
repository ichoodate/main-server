<?php

namespace Database\Seeds;

use App\Models\Notice;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 100; ++$i) {
            Notice::factory()->create();
        }
    }
}
