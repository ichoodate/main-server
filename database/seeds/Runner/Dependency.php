<?php

namespace Database\Seeds\Runner;

class Dependency {

    protected $seeders = [];

    const DEPENDENCIES = [
        'Database\Seeds\ActivityTableSeeder' => [
            'Database\Seeds\CardTableSeeder',
            'Database\Seeds\MatchTableSeeder',
            'Database\Seeds\ChattingContentTableSeeder',
            'Database\Seeds\ChattingRoomTableSeeder'
        ],
        'Database\Seeds\RoleTableSeeder' => [],
        'Database\Seeds\UserTableSeeder' => [],
        'Database\Seeds\RoleUserTableSeeder' => [
            'Database\Seeds\RoleTableSeeder',
            'Database\Seeds\UserTableSeeder'
        ],
        'Database\Seeds\MatchTableSeeder' => [
            'Database\Seeds\UserTableSeeder'
        ],
        'Database\Seeds\CardTableSeeder' => [
            'Database\Seeds\MatchTableSeeder'
        ],
        'Database\Seeds\ChattingContentTableSeeder' => [],
        'Database\Seeds\ChattingRoomActivityTableSeeder' => [
            'Database\Seeds\ChattingRoomTableSeeder'
        ],
        'Database\Seeds\ChattingRoomTableSeeder' => [],
        'Database\Seeds\NoticeTableSeeder' => [],
        'Database\Seeds\LanguageTableSeeder' => [],
        'Database\Seeds\KeywordAppearanceTableSeeder' => [],
        'Database\Seeds\BodyTableSeeder' => [],
        'Database\Seeds\BloodTableSeeder' => [],
        'Database\Seeds\CareerTableSeeder' => [],
        'Database\Seeds\CharacterTableSeeder' => [],
        'Database\Seeds\ResidenceCountryTableSeeder' => [],
        'Database\Seeds\ResidenceStateTableSeeder' => [],
        'Database\Seeds\CountryTableSeeder' => [],
        'Database\Seeds\StateTableSeeder' => [],
        'Database\Seeds\DrinkTableSeeder' => [],
        'Database\Seeds\HobbyTableSeeder' => [],
        'Database\Seeds\KeywordIdealTypeTableSeeder' => [],
        'Database\Seeds\ReligionTableSeeder' => []
    ];

    public function setSeeders(array $seeders)
    {
        $this->seeders = $seeders;

        return $this;
    }

    private function getDependencies($seeder)
    {
        $dependencies = static::DEPENDENCIES[$seeder];
        $result       = [];

        foreach ( $dependencies as $dependency )
        {
            $result[] = $dependency;

            $result = array_merge($result, $this->getDependencies($dependency));
        }

        return $result;
    }

    public function run()
    {
        $list = $this->seeders;

        foreach ( $this->seeders as $seeder )
        {
            $dependencies = $this->getDependencies($seeder);

            foreach ( $dependencies as $dependency )
            {
                $list[] = $dependency;
            }
        }

        $list = array_unique(array_reverse($list));

        foreach ( $list as $seeder )
        {
            (new $seeder)->run();
        }
    }

}
