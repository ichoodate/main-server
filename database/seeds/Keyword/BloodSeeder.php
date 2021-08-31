<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Blood;
use Illuminate\Database\Seeder;

class BloodSeeder extends Seeder
{
    public function run()
    {
        foreach (Blood::TYPE_VALUES as $type) {
            Blood::create([
                Blood::TYPE => $type,
            ]);
        }
    }
}
