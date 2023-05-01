<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Language;
use Database\DatabaseSeeder;

class LanguageSeeder extends DatabaseSeeder
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
