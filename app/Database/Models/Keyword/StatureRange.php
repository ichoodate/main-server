<?php

namespace App\Database\Models;

use App\Database\Model;

class StatureRange extends Model {

    protected $table = 'keyword_stature_ranges';
    protected $visible = [
        self::ID,
        self::DATA,
        self::MIN,
        self::MAX
    ];

    const DATA = 'data';
    const MIN  = 'min';
    const MAX  = 'max';

    const ENTITIES = [
        self::ID,
        self::DATA,
        self::MIN,
        self::MAX,
    ];

    const DATA_VALUES = [
        ['141', '145'],
        ['146', '150'],
        ['151', '155'],
        ['156', '160'],
        ['161', '165'],
        ['166', '170'],
        ['171', '175'],
        ['176', '180'],
        ['181', '185'],
        ['186', '190']
    ];

    public function setDataAttribute($value)
    {
        $this->attributes[static::MIN] = $value[0];
        $this->attributes[static::MAX] = $value[1];
    }

}
