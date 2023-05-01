<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Hobby;
use Database\DatabaseSeeder;

class HobbySeeder extends DatabaseSeeder
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
