<?php

namespace Database\Factories\Model;

use App\Database\Models\Obj;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class ObjFactory extends ModelFactory {

    public static function default()
    {
        return [
            Obj::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Obj::TYPE
                => inst(Faker::class)->randomElement(Obj::TYPE_VALUES)
        ];
    }

}