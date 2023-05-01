<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Religion;
use Database\DatabaseSeeder;

class ReligionSeeder extends DatabaseSeeder
{
    public function run()
    {
        foreach (Religion::TYPE_VALUES as $type) {
            $model = Religion::where([
                Religion::TYPE => $type,
            ])->first();

            if (empty($model)) {
                Religion::factory()->create([
                    Religion::TYPE => $type,
                ]);
            }
        }
    }
}
