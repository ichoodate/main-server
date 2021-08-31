<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    public const COUNTS = [
        'table' => [2, 3],
        'section' => [3, 5],
        'division' => [3, 5],
        'group' => [3, 5],
        'class' => [4, 5],
        'sub_class' => [5, 6],
    ];

    public function run()
    {
        $this->creates('table', null);
    }

    private function creates($category, $parentId)
    {
        $count = static::COUNTS[$category];
        $min = $count[0];
        $max = $count[1];
        $j = 1;

        for ($i = 0; $i < rand($min, $max); ++$i) {
            $count = Career::where(Career::TYPE, $category)->count();
            $model = Career::where([
                Career::PARENT_ID => $parentId,
                Career::NAME => $category.($count + 1),
            ])->first();

            if (empty($model)) {
                $model = Career::factory()->create([
                    Career::PARENT_ID => $parentId,
                    Career::TYPE => $category,
                    Career::NAME => $category.($count + 1),
                ]);
            }

            if ('sub_class' != $category) {
                $categories = array_keys(static::COUNTS);
                $nextCategory = $categories[array_search($category, $categories) + 1];

                $this->creates($nextCategory, $model->getKey());
            }
        }
    }
}
