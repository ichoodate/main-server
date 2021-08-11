<?php

namespace Database\Seeds\Table\Keyword;

use App\Models\Keyword\Language;
use Database\Seeds\TableSeeder;

class LanguageTableSeeder extends TableSeeder
{
    public function run()
    {
        foreach (Language::TYPE_VALUES as $type) {
            Language::create([
                Language::TYPE => $type,
            ]);
        }
    }
}
