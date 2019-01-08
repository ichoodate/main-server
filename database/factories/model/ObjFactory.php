<?php

namespace Database\Factories\Model;

use App\Database\Models\Obj;
use Faker\Generator as Faker;

class ObjFactory extends ModelFactory {

    public static function default()
    {
        return [
            Obj::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Obj::TYPE
                => inst(Faker::class)->randomElement(Obj::TYPE_VALUES)
        ];
    }

}
