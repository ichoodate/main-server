<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        foreach (Language::TYPE_VALUES as $type) {
            $model = Language::where([
                Language::TYPE => $type,
            ])->first();

            if (empty($model)) {
                Language::factory()->create([
                    Language::TYPE => $type,
                ]);
            }
        }
    }
}
