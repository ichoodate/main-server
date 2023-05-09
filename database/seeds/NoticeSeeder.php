<?php

namespace Database\Seeds;

use App\Models\Notice;
use Database\DatabaseSeeder;

class NoticeSeeder extends DatabaseSeeder
{
    public function run()
    {
        for ($i = 0; $i < 100; ++$i) {
            var_dump(static::class, $i);
            Notice::factory()->create();
        }
    }
}
