<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    public static function factory($modelClass)
    {
        $path = str_replace('App\\Database\\Models\\', '', $modelClass);

        return inst('Database\\Factories\\Model\\'.$path.'Factory');
    }
}
