<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Hobby;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    public function run()
    {
        foreach (Hobby::TYPE_VALUES as $type) {
            Hobby::create([
                Hobby::TYPE => $type,
            ]);
        }
    }
}
