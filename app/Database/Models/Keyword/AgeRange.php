<?php

namespace App\Database\Models;

use App\Database\Model;

class AgeRange extends Model {

    protected $table = 'keyword_age_ranges';
    protected $visible = [
        self::ID,
        self::DATA,
        self::MIN,
        self::MAX
    ];

    const MIN  = 'min';
    const MAX  = 'max';
    const DATA = 'data';

    const DATA_VALUES = [
        ['20', '25'],
        ['26', '30'],
        ['30', '35'],
        ['36', '40']
    ];

    public function setDataAttribute($value)
    {
        $this->attributes[static::MIN] = $value[0];
        $this->attributes[static::MAX] = $value[1];
    }

}
