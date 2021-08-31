<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Religion;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    public function run()
    {
        foreach (Religion::TYPE_VALUES as $type) {
            Religion::create([
                Religion::TYPE => $type,
            ]);
        }
    }
}
