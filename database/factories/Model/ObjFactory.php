<?php

namespace Database\Factories\Model;

use App\Models\Obj;
use Database\Factories\ModelFactory;

class ObjFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Obj::ID => static::faker()->unique()->randomNumber(8),

            Obj::TYPE => static::faker()->randomElement(Obj::TYPE_VALUES),
        ];
    }
}
