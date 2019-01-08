<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;

abstract class TableSeeder extends Seeder {

    protected function factory($modelClass)
    {
        $className = basename($modelClass);

        return inst('Database\\Factories\\Model\\' . $className . 'Factory');
    }

    protected function getClassName()
    {
        $paths = explode('\\', static::class);

        return array_pop($paths);
    }

    protected function getRelatedModel()
    {
        $class = str_replace('TableSeeder', '', $this->getClassName());

        return inst('App\\Database\\Models\\' . $class);
    }

}
