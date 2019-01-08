<?php

namespace Database\Seeds;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Career;

class CareerTableSeeder extends TableSeeder {

    const COUNTS = [
        Career::TABLE     => [2, 3],
        Career::SECTION   => [3, 5],
        Career::DIVISION  => [3, 5],
        Career::GROUP     => [3, 5],
        Career::CLASS     => [4, 5],
        Career::SUB_CLASS => [5, 6]
    ];

    public function run()
    {
        $this->creates(Career::TABLE, null);
    }

    private function creates($category, $parentId)
    {
        $count = static::COUNTS[$category];
        $min   = $count[0];
        $max   = $count[1];
        $j     = 1;

        for ( $i = 0; $i < rand($min, $max); $i++ )
        {
            $keyword = Obj::create([Obj::TYPE => Obj::TYPE_KEYWORD_CAREER]);

            $keywordCareer = Career::create([
                Career::PARENT_ID => $parentId,
                Career::TYPE      => $category,
                Career::CODE      => 'code' . $j++
            ]);

            if ( $category != Career::SUB_CLASS )
            {
                $categories   = array_keys(static::COUNTS);
                $nextCategory = $categories[array_search($category, $categories) + 1];

                $this->creates($nextCategory, $keywordCareer->getKey());
            }
        }
    }

}
