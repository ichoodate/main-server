<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Smoke;
use Illuminate\Database\Seeder;

class SmokeSeeder extends Seeder
{
    public function run()
    {
        foreach (Smoke::TYPE_VALUES as $type) {
            Smoke::create([
                Smoke::TYPE => $type,
            ]);
        }
    }
}
