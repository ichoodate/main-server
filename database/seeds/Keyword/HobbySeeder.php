<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Hobby;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    public function run()
    {
        foreach (Hobby::TYPE_VALUES as $type) {
            $model = Hobby::where([
                Hobby::TYPE => $type,
            ])->first();

            if (empty($model)) {
                Hobby::factory()->create([
                    Hobby::TYPE => $type,
                ]);
            }
        }
    }
}
