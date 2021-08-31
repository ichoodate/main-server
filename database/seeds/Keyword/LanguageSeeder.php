<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
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
