<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    public const COUNTS = [
        Career::TYPE_TABLE => [2, 3],
        Career::TYPE_SECTION => [3, 5],
        Career::TYPE_DIVISION => [3, 5],
        Career::TYPE_GROUP => [3, 5],
        Career::TYPE_CLASS => [4, 5],
        Career::TYPE_SUB_CLASS => [5, 6],
    ];

    public function run()
    {
        $this->creates(Career::TYPE_TABLE, null);
    }

    private function creates($category, $parentId)
    {
        $count = static::COUNTS[$category];
        $min = $count[0];
        $max = $count[1];
        $j = 1;

        for ($i = 0; $i < rand($min, $max); ++$i) {
            $count = Career::where(Career::TYPE, $category)->count();

            $keywordCareer = Career::create([
                Career::PARENT_ID => $parentId,
                Career::TYPE => $category,
                Career::NAME => $category.($count + 1),
            ]);

            if (Career::TYPE_SUB_CLASS != $category) {
                $categories = array_keys(static::COUNTS);
                $nextCategory = $categories[array_search($category, $categories) + 1];

                $this->creates($nextCategory, $keywordCareer->getKey());
            }
        }
    }
}
