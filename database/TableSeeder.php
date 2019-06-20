<?php

namespace Database;

use Illuminate\Database\Seeder;

class TableSeeder extends Seeder {

    protected $seeders = [];

    const DEPENDENCIES = [
        'ActivityTableSeeder' => [
            'CardTableSeeder'
        ],
        'MatchTableSeeder' => [
            'UserTableSeeder'
        ],
        'CardTableSeeder' => [
            'MatchTableSeeder'
        ],
        'ChattingContentTableSeeder' => [
            'MatchTableSeeder'
        ]
    ];

    private function getDependencies($seeder)
    {
        $result = [];

        if ( array_key_exists($seeder, static::DEPENDENCIES) )
        {
            $dependencies = static::DEPENDENCIES[$seeder];
        }

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

    protected function factory($modelClass)
    {
        $path = str_replace('App\\Database\\Models\\', '', $modelClass);

        return inst('Database\\Factories\\Models\\' . $path . 'Factory');
    }

    protected function getRelatedModel()
    {
        $paths = explode('\\', static::class);
        $class = array_pop($paths);
        $class = str_replace('TableSeeder', '', $class);

        return inst('App\\Database\\Models\\' . $class);
    }

}
